<?php

namespace App\Services;


use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AlbumService
{
    /**
     * @param $request
     * @return void
     */
    public function createAlbum($request): void
    {
        Album::create([
            'user_id' => $request->get('user_id'),
            'name' => $request->get('album_name'),
            'description' => $request->get('album_description')
        ]);
    }

    /**
     * @param $album
     * @param string $newName
     * @return void
     */
    public function changeAlbumName($album, string $newName): void
    {
        $album->name = $newName;
        $album->save();


    }

    public function changeAlbumDescription($album, string $newDescription): void
    {
        $album->description = $newDescription;
        $album->save();
    }

    /**
     * @param Album $album
     * @param bool $isDeletePhotosFromAlbum
     * @return void
     */
    public function deleteAlbum(Album $album, bool $isDeletePhotosFromAlbum = false): void
    {
        $photoService = new PhotoService();

        if ($isDeletePhotosFromAlbum) {
            foreach ($album->photos as $photo) {
                $photoService->deletePhoto($photo);
            }
        }

        $album->delete();
    }

    /**
     *
     * Удаляем альбом из базы
     *
     * @param Album $album
     * @return void
     */
    public function deleteAlbumPermanently(Album $album): void
    {
        $album->forceDelete();
    }

    /**
     *
     * Восстанавливаем альбом из корзины
     *
     * @param Album $album
     * @return void
     */
    public function restoreAlbum(Album $album): void
    {
        $album->restore();
        foreach ($album->trashedPhotos as $trashedPhoto) {
            $trashedPhoto->restore();
        }

    }
}
