<?php

namespace App\Services;


use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Image;

class PhotoService
{
    public function createPhoto($request)
    {
        $file = $request->file('user_photo');
        $filePath = 'userphotos/' . $request->get('user_id');
        $fileName = $request->get('photo_name');

        $uploadedFilePath = Storage::disk('public')->put($filePath, $file);

        $photo = Photo::create([
            'user_id' => $request->get('user_id'),
            'name' => $request->get('photo_name'),
            'description' => $request->get('photo_description'),
            'path' => $uploadedFilePath
        ]);

        if ($request->get('album_id')) {
            $photo->associateAlbumPhoto($request->get('album_id'), $photo->id);
        }

    }

    public function changePhotoName($photo, string $newName)
    {
        $photo->name = $newName;
        $photo->save();
    }

    public function changePhotoDescription($photo, string $newDescription)
    {
        $photo->description = $newDescription;
        $photo->save();
    }

    public function deletePhoto($photo)
    {
        $photo->delete();
    }

    public function deletePhotoPermanently(Photo $photo)
    {
        $photo->forceDelete();
    }
}
