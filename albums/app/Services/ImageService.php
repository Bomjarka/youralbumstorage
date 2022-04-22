<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageService
{
    const FILEPATH = 'userphotos/';

    public function  __construct()
    {
        if (!Storage::disk('public')->exists(self::FILEPATH)) {
            Storage::disk('public')->makeDirectory(self::FILEPATH);
        }
    }

    public function createImage($file, $userid)
    {
        $filePath = self::FILEPATH . $userid;
        $this->checkFolder($filePath);
        $fileName = $this->createFilename($file);

        $img = Image::make($file);
        $img->save(Storage::disk('public')->path($filePath . '/' . $fileName));

        return $filePath . '/' . $fileName;
    }

    public function createPreview($file, $userid)
    {
        $filePath = self::FILEPATH . $userid . '/preview';
        $this->checkFolder($filePath);
        $fileName = $this->createFilename($file);
        $img = Image::make($file);
        $img->fit(600, 400);
        $img->save(Storage::disk('public')->path($filePath . '/' . $fileName));

        return $filePath . '/' . $fileName;
    }

    public function deleteImage($photo)
    {
//        if (!Storage::disk('public')->exists($photo->photo_path)
//            || !Storage::disk('public')->exists($photo->photo_preview_path)) {
//            return \Exception::class;
//        }

        Storage::disk('public')->delete($photo->photo_path);
        Storage::disk('public')->delete($photo->photo_preview_path);

        return true;
    }

    private function createFilename($file)
    {
        return Str::random(20) . $file->getClientOriginalName();
    }

    private function checkFolder($filepath)
    {
        if (!Storage::disk('public')->exists($filepath)) {
            Storage::disk('public')->makeDirectory($filepath);
        }
    }
}
