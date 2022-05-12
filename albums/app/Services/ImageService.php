<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{
    public const FILEPATH = 'userphotos/';

    public function __construct()
    {
        if (!Storage::disk('public')->exists(self::FILEPATH)) {
            Storage::disk('public')->makeDirectory(self::FILEPATH);
        }
    }

    /**
     *
     * Создаём изображение
     *
     * @param $file
     * @param $userid
     * @return string
     */
    public function createImage($file, $userid): ?string
    {
        try {
            $filePath = self::FILEPATH . $userid;
            $this->checkFolder($filePath);
            $fileName = $this->createFilename($file);
            $img = Image::make($file);
            $img->save(Storage::disk('public')->path($filePath . '/' . $fileName));

            return $filePath . '/' . $fileName;
        } catch (\Exception $e) {
            Log::critical('Error when create Image: ' . $e->getMessage(), ['fileData' => $file, 'errorRow' => $e->getLine()]);
            DB::rollBack();
            return null;
        }

    }

    /**
     *
     * Создаём превью изображения
     *
     * @param $file
     * @param $userid
     * @return string
     */
    public function createPreview($file, $userid): ?string
    {
        try {
            $filePath = self::FILEPATH . $userid . '/preview';
            $this->checkFolder($filePath);
            $fileName = $this->createFilename($file);
            $img = Image::make($file);
            $img->fit(600, 400);
            $img->save(Storage::disk('public')->path($filePath . '/' . $fileName));

            return $filePath . '/' . $fileName;
        } catch (\Exception $e) {
            Log::critical('Error when create Image: ' . $e->getMessage(), ['fileData' => $file]);

            return null;
        }
    }

    /**
     * Удаляет файлы с фотографиями
     *
     * @param $photo
     * @return bool
     */
    public function deleteImage($photo): bool
    {
        Storage::disk('public')->delete($photo->photo_path);
        Storage::disk('public')->delete($photo->photo_preview_path);

        return true;
    }

    /**
     * @param $file
     * @return string
     */
    private function createFilename($file): string
    {
        return Str::random(20) . $file->getClientOriginalName();
    }

    /**
     * @param $filepath
     * @return void
     */
    private function checkFolder($filepath): void
    {
        if (!Storage::disk('public')->exists($filepath)) {
            Storage::disk('public')->makeDirectory($filepath);
        }
    }
}
