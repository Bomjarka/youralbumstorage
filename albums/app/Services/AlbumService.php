<?php

namespace App\Services;


use App\Models\Album;

class AlbumService
{
    public function createAlbum()
    {
        $album = new Album();
        $album->user_id = 1;
        $album->name = 'Album Name 2';
        $album->description = 'Description 2';
    }

    public function deleteAlbum(Album $album, bool $isDeletePhotosFromAlbum = false)
    {
        $photoService = new PhotoService();

        if ($isDeletePhotosFromAlbum == true) {
            foreach ($album->photos() as $photo) {
                $photoService->deletePhoto($photo);
            }
        }

        $album->delete();
    }

    public function deleteAlbumPermanently(Album $album)
    {
        $album->forceDelete();
    }
}
