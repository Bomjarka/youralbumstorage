<?php

namespace App\Services;


use App\Models\Album;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AlbumService
{

    /**
     * @param array $data
     * @return void
     */
    public function createAlbum(array $data): void
    {
        Album::create([
            'user_id' => $data['user_id'],
            'name' => $data['album_name'],
            'description' => $data['album_description']
        ]);
    }

    /**
     * @param Album $album
     * @param string $newName
     * @return void
     */
    public function changeAlbumName(Album $album, string $newName): void
    {
        $album->name = $newName;
        $album->save();


    }

    /**
     * @param Album $album
     * @param string $newDescription
     * @return void
     */
    public function changeAlbumDescription(Album $album, string $newDescription): void
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
