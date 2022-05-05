<?php

namespace App\Http\Controllers;

use App\Events\NotificationRead;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\DownloadPhotosNotification;
use App\Services\PhotoService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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

        $photoService->createPhoto($request);

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
        $newDescription = $request->get('photo_description');

        $photoService->changePhotoName($photo, $newName);
        $photoService->changePhotoDescription($photo, $newDescription);

        if ($request->get('album_id')) {
            //Если фото принадлежит какому то альбому, то необходимо удалить связь между ними
            if ($photo->album->first()) {
                $photo->disassociateAlbumPhoto($photo->album->first()->id);
            }
            //Если мы переносим фото в конкретный альбом, то необходимо связать их
            if ($request->get('album_id') != self::NO_ALBUM) {
                $photo->associateAlbumPhoto($request->get('album_id'));
            }
        }
        return redirect()->back();
    }


    /**
     *
     * Скачать все фотографии, подготавливает архив со всеми пользовательскими изображениями
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function downloadAllPhotos(Request $request): JsonResponse
    {
        $user = User::find($request->get('userId'));
        $archivePath = Storage::path('public/userphotos/' . $user->id . '/photos.zip');
        $zip = new ZipArchive();
        $albums = $user->albums;

        $zip->open($archivePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        foreach ($albums as $album) {
            foreach ($album->photos as $albumPhoto) {
                $image = Image::make(Storage::disk('local')->path('public/' . $albumPhoto->photo_path));

                $zip->addFromString($albumPhoto->name . '.' . $image->extension, $image->encode($image->extension));
            }
        }
        $zip->close();

        //Отправим пользователю письмо с ссылкой на скачивание архива
        $user->notify(new DownloadPhotosNotification($archivePath));

        return response()->json([
            'msg' => 'Check your email, we sent link for downloading archive',
            'status' => 'archive-sent',
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
        $filePath = Storage::path('public/userphotos/' . $user->id . '/' . $filename);
        if ($filePath) {
            event(new NotificationRead($user, $request->get('notification')));

            return response()->download($filePath)->deleteFileAfterSend();
        }

        return redirect('/');
    }
}
