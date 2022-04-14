<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Services\AlbumService;
use Illuminate\Http\Request;


class AlbumController extends Controller
{
    public function index(Album $album)
    {
        $albumPhotosId = AlbumPhotos::whereAlbumId($album->id)->get()->pluck('photo_id');
        $photos = Photo::whereIn('id', $albumPhotosId)->orderBy('id')->get();

        return view('user.album', ['album' => $album, 'photos' => $photos]);
    }

    public function delete(Request $request, Album $album, AlbumService $albumService)
    {
        $isDeletePhotosFromAlbum = $request->get('delete_photos');

        if (is_null($isDeletePhotosFromAlbum)) {
            $albumService->deleteAlbum($album);
        } elseif ($isDeletePhotosFromAlbum == true) {
            $albumService->deleteAlbum($album, $isDeletePhotosFromAlbum);
        }

        return redirect('albums');
    }

    public function create(Request $request, AlbumService $albumService)
    {
        $albumService->createAlbum($request);

        return redirect()->back();
    }

    public function edit(Request $request, Album $album, AlbumService $albumService)
    {
        $newName = $request->get('album_name');
        $newDescription = $request->get('album_description');

        $albumService->changeAlbumName($album, $newName);
        $albumService->changeAlbumDescription($album, $newDescription);

        return redirect()->back();
    }
}
