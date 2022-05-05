<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Services\AlbumService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AlbumController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            $albums = Album::whereUserId($user->id)->orderBy('id')->simplePaginate(5);
            return view('user.albums', ['albums' => $albums]);
        }

        return view('guest.albums');
    }

    public function album(Album $album)
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
        $request->validate([
            'album_name' => ['required', 'string', 'max:255'],
            'album_description' => ['nullable', 'string', 'max:255'],
        ]);

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

    public function restoreAlbum(Request $request, AlbumService $albumService)
    {
        $album = Album::withTrashed()->find($request->get('albumId'));
        $albumService->restoreAlbum($album);

        return response()->json([
            'msg' => 'Album restored!',
        ]);
    }
}
