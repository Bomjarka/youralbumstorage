<?php

namespace App\Http\Controllers;

use App\Events\NotificationRead;
use App\Models\Photo;
use App\Models\User;
use App\Notifications\DownloadPhotosNotification;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use ZipArchive;

class PhotoController extends Controller
{
    public const NO_ALBUM = 'no_album';

    public function index()
    {
        return view('user.photo');
    }

    public function create(Request $request, PhotoService $photoService)
    {
        $request->validate([
            'photo_name' => ['required', 'string', 'max:255'],
            'photo_description' => ['nullable', 'string', 'max:255'],
        ]);

        $photoService->createPhoto($request);

        return redirect()->back();
    }

    public function delete(Photo $photo, PhotoService $photoService)
    {
        $photoService->deletePhoto($photo);

        return redirect()->back();
    }

    public function edit(Request $request, Photo $photo, PhotoService $photoService)
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

    public function restorePhoto(Request $request, PhotoService $photoService)
    {
        $photo = Photo::withTrashed()->find($request->get('photoId'));
        $photoService->restorePhoto($photo);

        return response()->json([
            'msg' => 'Photo restored!',
        ]);
    }

    public function downloadAllPhotos(Request $request)
    {
        $user = User::find($request->get('userId'));
        $archivePath = Storage::path('public/userphotos/' . $user->id . '/photos.zip');
        $zip = new ZipArchive();
        $albums = $user->albums;

        $zip->open($archivePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        foreach ($albums as $album) {
            foreach ($album->photos as $albumPhoto) {
                $image = Image::make(Storage::disk('local')->path('public/' . $albumPhoto->photo_path));

                $zip->addFromString($albumPhoto->name . '.' . $image->extension, $image->encode($image->extension));
            }
        }
        $zip->close();

        $user->notify(new DownloadPhotosNotification($archivePath));

        return response()->json([
            'msg' => 'Check your email, we sent link for downloading archive',
            'status' => 'archive-sent',
        ]);
    }

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
