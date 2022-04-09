<?php

namespace App\Services;


use App\Models\Photo;

class PhotoService
{
    public function deletePhoto($photo)
    {
        $photo->delete();
    }

    public function deletePhotoPermanently(Photo $photo)
    {
        $photo->forceDelete();
    }
}
