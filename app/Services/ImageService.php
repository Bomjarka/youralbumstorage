<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{
    public const USERPHOTOS = 'userphotos/';

    public const PREVIEW = '/preview';

    public function __construct()
    {
        if (!Storage::disk('public')->exists(self::USERPHOTOS)) {
            Storage::disk('public')->makeDirectory(self::USERPHOTOS);
        }
    }

    /**
     * Создаём изображение и сохраняем в папку пользователя
     *
     * @param UploadedFile $file
     * @param int $userid
     * @return string
     */
    public function createImage(UploadedFile $file, int $userid): ?string
    {
        try {
            $filePath = self::USERPHOTOS . $userid;
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
     * Создаём превью изображения и сохраняем в папку пользователя
     *
     * @param UploadedFile $file
     * @param int $userid
     * @return string
     */
    public function createPreview(UploadedFile $file, int $userid): ?string
    {
        try {
            $filePath = self::USERPHOTOS . $userid . self::PREVIEW;
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
     * @param Photo $photo
     * @return bool
     */
    public function deleteImage(Photo $photo): bool
    {
        try {
            Storage::disk('public')->delete($photo->photo_path);
            Storage::disk('public')->delete($photo->photo_preview_path);

            return true;
        } catch (\Exception $e) {
            Log::critical('Error when delete photo from storage: ' . $e->getMessage(), ['photo' => $photo]);

            return false;
        }
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function createFilename(UploadedFile $file): string
    {
        return Str::random(20) . $file->getClientOriginalName();
    }

    /**
     * @param string $filepath
     * @return void
     */
    private function checkFolder(string $filepath): void
    {
        if (!Storage::disk('public')->exists($filepath)) {
            Storage::disk('public')->makeDirectory($filepath);
        }
    }
}
