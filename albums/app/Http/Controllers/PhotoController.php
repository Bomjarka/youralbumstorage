<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    const NO_ALBUM = 'no_album';

    public function index()
    {
        return view('user.photo');
    }

    public function create(Request $request, PhotoService $photoService)
    {
        //Сделать валидатор
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
}
