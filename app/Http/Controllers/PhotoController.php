<?php

namespace App\Http\Controllers;

use App\Events\NotificationRead;
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
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\TranslationLoader\LanguageLine;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;

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
     * @return RedirectResponse
     */
    public function create(Request $request, PhotoService $photoService): RedirectResponse
    {
        $request->validate([
            'photo_name' => ['required', 'string', 'max:255'],
            'photo_description' => ['nullable', 'string', 'max:255'],
        ]);

        $photo = $photoService->createPhoto($request);
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
        Log::info('Photo deleted by user', ['album: ' => $photo]);

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
        $zip = new ZipArchive();

        $zip->open($archivePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        //скачаем все фото в альбомах и разложим по папкам
        try {
            foreach ($user->albums as $album) {
                if ($album->photos->count() != 0) {
                    foreach ($album->photos as $photo) {
                        $image = Image::make(Storage::disk('public')->path($photo->photo_path));
                        $zip->addFromString($album->name . '/' . $photo->name . '.' . $image->extension, $image->encode($image->extension));
                    }
                }
            }
            //скачаем все фото без альбомов
            foreach ($user->photos as $photo) {
                if (!$photo->album->first()) {
                    $image = Image::make(Storage::disk('public')->path($photo->photo_path));
                    $zip->addFromString($withoutAlbum . '/' . $photo->name . '.' . $image->extension, $image->encode($image->extension));
                }
            }
        } catch (\Throwable $e) {
            Log::error('Error when creating ZIP', [
                'User: ' => $user,
                'Photo' => $photo,
                'Album' => $album ?? null,
                'ZIP' => $zip,
            ]);

            throw new Exception('Something wrong while creating ZIP archive');

        } finally {
            $zip->close();
        }

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
     * @return Application|RedirectResponse|Redirector|BinaryFileResponse
     */
    public function download(Request $request, string $filename)
    {
        $user = Auth::user();
        $filePath = Storage::disk('public')->path('userphotos/' . $user->id . '/' . $filename);
        if ($filePath) {
            event(new NotificationRead($user, $request->get('notification')));

            return response()->download($filePath)
                ->deleteFileAfterSend();
        }

        return redirect('/');
    }
}
