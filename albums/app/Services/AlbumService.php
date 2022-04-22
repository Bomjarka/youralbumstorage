<?php

namespace App\Services;


use App\Models\Album;
use App\Models\User;

class AlbumService
{
    public function createAlbum($request)
    {
        Album::create([
            'user_id' => $request->get('user_id'),
            'name' => $request->get('album_name'),
            'description' => $request->get('album_description')
        ]);
    }

    public function changeAlbumName($album, string $newName)
    {
        $album->name = $newName;
        $album->save();
    }

    public function changeAlbumDescription($album, string $newDescription)
    {
        $album->description = $newDescription;
        $album->save();
    }

    public function deleteAlbum(Album $album, bool $isDeletePhotosFromAlbum = false)
    {
        $photoService = new PhotoService();

        if ($isDeletePhotosFromAlbum == true) {
            foreach ($album->photos as $photo) {
                $photoService->deletePhoto($photo);
            }
        }

        $album->delete();
    }

    public function deleteAlbumPermanently(Album $album)
    {
        $album->forceDelete();
    }

    public function restoreAlbum(Album $album)
    {
        $album->restore();

        foreach ($album->trashedPhotos as $trashedPhoto) {
            $trashedPhoto->restore();
        }
    }
}
