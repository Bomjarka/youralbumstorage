<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
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
            if ($photo->album->isNotEmpty()) {
                if ($request->get('album_id') != $photo->album->first()->id) {
                    $photo->disassociateAlbumPhoto($photo->album->first()->id);
                }
            }

            $photo->associateAlbumPhoto($request->get('album_id'));
        }
        return redirect()->back();
    }
}
