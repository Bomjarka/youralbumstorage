<?php

namespace App\Jobs;

use App\Models\User;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use ZipArchive;

class DownloadPhotosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;

    public $withoutAlbum;

    public $archivePath;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $archivePath, string $withoutAlbum)
    {
        $this->user = $user;
        $this->withoutAlbum = $withoutAlbum;
        $this->archivePath = $archivePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $zip = new ZipArchive();

        $zip->open($this->archivePath, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        //скачаем все фото в альбомах и разложим по папкам
        try {
            foreach ($this->user->albums as $album) {
                if ($album->photos->count() != 0) {
                    foreach ($album->photos as $photo) {
                        $image = Image::make(Storage::disk('public')->path($photo->photo_path));
                        $zip->addFromString($album->name . '/' . $photo->name . '.' . $image->extension, $image->encode($image->extension));
                    }
                }
            }
            //скачаем все фото без альбомов
            foreach ($this->user->photos as $photo) {
                if (!$photo->album->first()) {
                    $image = Image::make(Storage::disk('public')->path($photo->photo_path));
                    $zip->addFromString($this->withoutAlbum . '/' . $photo->name . '.' . $image->extension, $image->encode($image->extension));
                }
            }
        } catch (\Throwable $e) {
            Log::error('Error when creating ZIP', [
                'User: ' => $this->user,
                'Photo' => $photo,
                'Album' => $album ?? null,
                'ZIP' => $zip,
            ]);

            throw new Exception('Something wrong while creating ZIP archive');

        } finally {
            $zip->close();
        }
    }
}
