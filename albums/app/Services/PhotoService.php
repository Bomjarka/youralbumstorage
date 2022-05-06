<?php

namespace App\Services;


use App\Models\Photo;

class PhotoService
{
    /**
     * @param $request
     * @return void
     */
    public function createPhoto($request): void
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

    /**
     * @param $photo
     * @param string $newName
     * @return void
     */
    public function changePhotoName($photo, string $newName): void
    {
        $photo->name = $newName;
        $photo->save();
    }

    /**
     * @param $photo
     * @param string $newDescription
     * @return void
     */
    public function changePhotoDescription($photo, string $newDescription): void
    {
        $photo->description = $newDescription;
        $photo->save();
    }

    /**
     * @param $photo
     * @return void
     */
    public function deletePhoto($photo): void
    {
        $photo->delete();
    }

    /**
     * @param Photo $photo
     * @return void
     */
    public function deletePhotoPermanently(Photo $photo): void
    {
        $imageService = new ImageService();
        $imageService->deleteImage($photo);
        $photo->forceDelete();
    }

    /**
     * @param Photo $photo
     * @return void
     */
    public function restorePhoto(Photo $photo): void
    {
        if ($photo->trashedAlbum()->first()) {
            $photo->disassociateAlbumPhoto($photo->trashedAlbum()->first()->id);
        }
        $photo->restore();
    }
}
