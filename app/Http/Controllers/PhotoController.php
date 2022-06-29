<?php

namespace App\Http\Controllers;

use App\Events\NotificationRead;
use App\Jobs\DownloadPhotosJob;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\DownloadPhotosNotification;
use App\Services\PhotoService;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\TranslationLoader\LanguageLine;

class PhotoController extends Controller
{
    public const NO_ALBUM = 'no_album';

    /**
     *
     * Возвращает страницу с фотографиями
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if ($user = Auth::user()) {
            $photos = Photo::whereUserId($user->id)->orderBy('id')->get();
            return view('user.photos', ['photos' => $photos]);
        }

        return view('guest.photos');
    }

    /**
     *
     * Создать новую фотографию
     *
     * @param Request $request
     * @param PhotoService $photoService
     */
    public function create(Request $request, PhotoService $photoService)
    {
        $validator = Validator::make($request->all(),
            [
                'photo_name' => ['required', 'string', 'max:255'],
                'photo_description' => ['nullable', 'string', 'max:255'],
                'user_photo' => ['required', 'mimes:jpg,png']
            ],
            [
                'user_photo.uploaded' => 'You try to upload wrong file',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $photoData = [
            'user_id' => $request->get('user_id'),
            'photo_name' => $request->get('photo_name'),
            'photo_description' => $request->get('photo_description'),
            'album_id' => $request->get('album_id'),
            'user_photo' => $request->file('user_photo'),
        ];

        $photo = $photoService->createPhoto($photoData);
        Log::info('New photo created', ['Photo' => $photo]);

        return redirect()->back();
    }

    /**
     *
     * Удалить фото
     *
     * @param Photo $photo
     * @param PhotoService $photoService
     * @return RedirectResponse
     */
    public function delete(Photo $photo, PhotoService $photoService): RedirectResponse
    {
        $photoService->deletePhoto($photo);

        return redirect()->back();
    }

    /**
     *
     * Редакетировать данные фотографии
     *
     * @param Request $request
     * @param Photo $photo
     * @param PhotoService $photoService
     * @return RedirectResponse
     */
    public function edit(Request $request, Photo $photo, PhotoService $photoService): RedirectResponse
    {
        $newName = $request->get('photo_name');
        $newDescription = $request->get('photo_description') ?? '';

        Log::info('Photo updated', ['photo: ' => $photo, 'New Name' => $newName, 'New Description' => $newDescription]);
        $photoService->changePhotoName($photo, $newName);
        $photoService->changePhotoDescription($photo, $newDescription);

        if ($request->get('album_id')) {
            //Если фото принадлежит какому-то альбому, то необходимо удалить связь между ними
            if ($photo->album->first()) {
                $photo->disassociateAlbumPhoto($photo->album->first()->id);
                Log::info('Photo disassociated from album', ['photo' => $photo, 'album: ' => $photo->album]);
            }
            //Если мы переносим фото в конкретный альбом, то необходимо связать их
            $photo->associateAlbumPhoto($request->get('album_id'));
            Log::info('Photo associated to album', ['photo' => $photo, 'album: ' => $photo->album]);
        }
        return redirect()->back();
    }


    /**
     *
     * Скачать все фотографии, подготавливает архив со всеми пользовательскими изображениями
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function downloadAllPhotos(Request $request): JsonResponse
    {
        $withoutAlbum = LanguageLine::where('group', 'base-phrases')
            ->where('key', 'without-albums')
            ->first()
            ->text[App::getLocale()];

        $user = User::find($request->get('userId'));

        if ($user->photos->count() == 0) {
            return response()->json([
                'msg' => 'no-photos',
            ]);
        }

        $archivePath = Storage::disk('public')->path('userphotos/' . $user->id . '/photos.zip');
        dispatch(new DownloadPhotosJob($user, $archivePath, $withoutAlbum))->onQueue('downloads');

        //Отправим пользователю письмо со ссылкой на скачивание архива
        $user->notify(new DownloadPhotosNotification($archivePath));
        Log::info('Download files notification message sent', ['UserId: ' => $user->id]);

        return response()->json([
            'msg' => 'success',
        ]);
    }

    /**
     *
     * Скачивание архива по ссылке из письма
     *
     * @param Request $request
     * @param string $filename
     * @return Application|RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(Request $request, string $filename)
    {
        $user = Auth::user();
        $filePath = Storage::disk('public')->path('userphotos/' . $user->id . '/' . $filename);
        if ($filePath) {
            $notification = $request->get('notification');

//            if (App::environment(['production'])) {
                if (DatabaseNotification::find($notification)->read()) {
                    return response()->view('errors.link-already-used');
                }
//            }

            event(new NotificationRead($user, $request->get('notification')));

            return response()->download($filePath)
                ->deleteFileAfterSend();
        }

        return redirect('/');
    }
}
