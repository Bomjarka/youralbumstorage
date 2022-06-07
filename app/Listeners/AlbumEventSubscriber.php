<?php

namespace App\Listeners;

use App\Events\Album\DeleteAlbumWithPhotos;
use App\Services\PhotoService;

class AlbumEventSubscriber extends EventSubscriber
{
    /**
     * @param $event
     * @return void
     */
    public function handleDeleteAlbumWithPhotos($event): void
    {
        $photoService = new PhotoService();
        $album = $event->album;

        foreach ($album->photos as $photo) {
            $photoService->deletePhoto($photo);
        }
    }

    /**
     * @inheritDoc
     */
    public function subscribe($events): void
    {
        $events->listen(
            DeleteAlbumWithPhotos::class,
            'App\Listeners\AlbumEventSubscriber@handleDeleteAlbumWithPhotos'
        );
    }
}
