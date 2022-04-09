<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        return view('user.photo');
    }

    public function delete(Request $request, Photo $photo, PhotoService $photoService)
    {
        $photoService->deletePhoto($photo);

        return redirect()->back();
    }
}
