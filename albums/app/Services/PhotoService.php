<?php

namespace App\Services;


use App\Models\Photo;

class PhotoService
{

    public function createPhoto($request)
    {
        $imageService = new ImageService();
        $file = $request->file('user_photo');

        $filePath = $imageService->createImage($file, $request->get('user_id'));
        $previewFilePath = $imageService->createPreview($file, $request->get('user_id'));

        $photo = Photo::create([
            'user_id' => $request->get('user_id'),
            'name' => $request->get('photo_name'),
            'description' => $request->get('photo_description'),
            'photo_path' => $filePath,
            'photo_preview_path' => $previewFilePath,
        ]);

        if ($request->get('album_id')) {
            $photo->associateAlbumPhoto($request->get('album_id'), $photo->id);
        }

    }

    public function changePhotoName($photo, string $newName)
    {
        $photo->name = $newName;
        $photo->save();
    }

    public function changePhotoDescription($photo, string $newDescription)
    {
        $photo->description = $newDescription;
        $photo->save();
    }

    public function deletePhoto($photo)
    {


        $photo->delete();
    }

    public function deletePhotoPermanently(Photo $photo)
    {
        $imageService = new ImageService();
        $imageService->deleteImage($photo);
        $photo->forceDelete();
    }

    public function restorePhoto(Photo $photo)
    {
        if ($photo->trashedAlbum()->first()) {
            $photo->disassociateAlbumPhoto($photo->trashedAlbum()->first()->id);
        }
        $photo->restore();
    }
}
