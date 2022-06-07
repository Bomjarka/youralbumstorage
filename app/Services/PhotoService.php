<?php

namespace App\Services;


use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PhotoService
{
    /**
     * @param array $data
     * @return Photo
     */
    public function createPhoto(array $data): Photo
    {
        DB::beginTransaction();
        $imageService = new ImageService();
        $file = $data['user_photo'];

        $filePath = $imageService->createImage($file, $data['user_id']);
        $previewFilePath = $imageService->createPreview($file, $data['user_id']);

        $photo = Photo::create([
            'user_id' => $data['user_id'],
            'name' => $data['photo_name'],
            'description' => $data['photo_description'],
            'photo_path' => $filePath,
            'photo_preview_path' => $previewFilePath,
        ]);

        if ($data['album_id']) {
            $photo->associateAlbumPhoto($data['album_id'], $photo->id);
        }
        DB::commit();

        return $photo;

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

        Log::info('Photo deleted', ['photo: ' => $photo]);
    }

    /**
     * @param Photo $photo
     * @return void
     */
    public function deletePhotoPermanently(Photo $photo): void
    {
        $imageService = new ImageService();
        if ($imageService->deleteImage($photo)) {
            $photo->forceDelete();
        }
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
