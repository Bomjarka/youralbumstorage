<?php

namespace App\Console\Commands;


use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Services\AlbumService;
use App\Services\PhotoService;
use Illuminate\Console\Command;

class DeleteUsersPhotosAndAlbums extends Command
{
    protected $signature = 'delete-photos-and-albums';

    protected $name = 'DeleteUsersPhotosAndAlbums';

    public function handle(PhotoService $photoService, AlbumService $albumService)
    {

        $albumsQuery = Album::onlyTrashed();
        $photosQuery = Photo::onlyTrashed();

        foreach ($albumsQuery->cursor() as $album) {
            $albumService->deleteAlbumPermanently($album);
        }

        foreach ($photosQuery->cursor() as $photo) {
            $photoService->deletePhotoPermanently($photo);
        }
    }
}
