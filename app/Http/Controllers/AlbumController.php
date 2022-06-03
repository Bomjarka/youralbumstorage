<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumPhotos;
use App\Models\Photo;
use App\Services\AlbumService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AlbumController extends Controller
{
    /**
     *
     * Возвращает страницу с альбомами
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if ($user = Auth::user()) {
            $albums = Album::whereUserId($user->id)->orderBy('id')->simplePaginate(5);

            return view('user.albums', ['albums' => $albums]);
        }

        return view('guest.albums');
    }

    /**
     *
     * Возвращает страницу открытого пользователем альбома
     *
     * @param Album $album
     * @return Application|Factory|View
     */
    public function album(Album $album)
    {
        $albumPhotosId = AlbumPhotos::whereAlbumId($album->id)->get()->pluck('photo_id');
        $photos = Photo::whereIn('id', $albumPhotosId)->orderBy('id')->get();

        return view('user.album', ['album' => $album, 'photos' => $photos]);
    }

    /**
     *
     * Удаление альбома
     *
     * @param Request $request
     * @param Album $album
     * @param AlbumService $albumService
     * @return Application|RedirectResponse|Redirector
     */
    public function delete(Request $request, Album $album, AlbumService $albumService)
    {
        //Передаём из blade значение чекбокса с вопросм удалить ли все фото из альбома
        $isDeletePhotosFromAlbum = $request->get('delete_photos');

        if (is_null($isDeletePhotosFromAlbum)) {
            $albumService->deleteAlbum($album);
        } elseif ($isDeletePhotosFromAlbum == true) {
            $albumService->deleteAlbum($album, $isDeletePhotosFromAlbum);
        }

        Log::info('Album deleted by user', ['album: ' => $album, 'Are photo deleted from album' => $isDeletePhotosFromAlbum]);

        return redirect('albums');
    }

    /**
     *
     * Создать новый альбом
     *
     * @param Request $request
     * @param AlbumService $albumService
     * @return RedirectResponse
     */
    public function create(Request $request, AlbumService $albumService): RedirectResponse
    {
        $validator = Validator::make($request->all(),
            [
                'album_name' => ['required', 'string', 'max:255'],
                'album_description' => ['nullable', 'string', 'max:255'],
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $photoData = [
            'user_id' => $request->get('user_id'),
            'album_name' => $request->get('album_name'),
            'album_description' => $request->get('album_description'),
        ];

        $albumService->createAlbum($photoData);

        return redirect()->back();
    }

    /**
     *
     * Редактировать данные об альбоме
     *
     * @param Request $request
     * @param Album $album
     * @param AlbumService $albumService
     * @return RedirectResponse
     */
    public function edit(Request $request, Album $album, AlbumService $albumService): RedirectResponse
    {
        $newName = $request->get('album_name');
        $newDescription = $request->get('album_description') ?? '';


        Log::info('Album updated', ['album: ' => $album, 'New Name' => $newName, 'New Description' => $newDescription]);
        $albumService->changeAlbumName($album, $newName);
        $albumService->changeAlbumDescription($album, $newDescription);
        return redirect()->back();
    }
}
