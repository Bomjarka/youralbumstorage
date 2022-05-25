<?php

namespace App\Console\Commands;


use App\Models\Album;
use App\Models\Photo;
use App\Services\AlbumService;
use App\Services\PhotoService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteUsersPhotosAndAlbums extends Command
{
    protected $signature = 'delete-photos-and-albums';

    protected $name = 'DeleteUsersPhotosAndAlbums';

    protected $description = 'Команда для удаления фотография и альбомов, которые были удалены пользователем';

    public function handle(PhotoService $photoService, AlbumService $albumService)
    {
        $filesLifetime = config('filesystems.lifetime');

        $dateOfDeletion = Carbon::now()->startOfDay();

        $albumsQuery = Album::onlyTrashed()->where('deleted_at', '<', $dateOfDeletion->copy()->subDays($filesLifetime));
        $photosQuery = Photo::onlyTrashed()->where('deleted_at', '<', $dateOfDeletion->copy()->subDays($filesLifetime));

        Log::info('Daily deleting user data', ['Photos count' => $photosQuery->count(), 'Albums count' => $albumsQuery->count()]);

        foreach ($albumsQuery->cursor() as $album) {
            $albumService->deleteAlbumPermanently($album);
        }

        foreach ($photosQuery->cursor() as $photo) {
            $photoService->deletePhotoPermanently($photo);
        }
    }
}
