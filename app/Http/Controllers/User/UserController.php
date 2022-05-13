<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Photo;
use App\Models\User;
use App\Services\AlbumService;
use App\Services\PhotoService;
use App\Services\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     *
     * Возвращает страниу с альбомами
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('user.albums');
    }

    /**
     *
     * Возвращает страницу с профилем пользователя
     *
     * @return Application|Factory|View
     */
    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    /**
     *
     * Редактировать данные пользователя
     *
     * @param Request $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function edit(Request $request, UserService $userService): JsonResponse
    {
        $user = User::find($request->get('userId'));

        $request->validate([
            'login' => ['string', 'max:255'],
            'first_name' => ['string', 'max:255'],
            'second_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone' => ['string', 'min:11', 'max:11'],
            'gender' => ['required', 'string'],
            'birthdate' => ['date'],
        ]);

        $userData = [];
        foreach ($request->all() as $key => $value) {
            if ($key == '_token') {
                continue;
            }
            $userData[$key] = $value;
        }

        $userService->editData($userData, $user);

        return response()->json([
            'msg' => 'User data updated!',
        ]);
    }

    /**
     *
     * Восстановить альбом из вкладки корзина
     *
     * @param Request $request
     * @param AlbumService $albumService
     * @return JsonResponse
     */
    public function restoreAlbum(Request $request, AlbumService $albumService): JsonResponse
    {
        $album = Album::withTrashed()->find($request->get('albumId'));
        $albumService->restoreAlbum($album);

        return response()->json([
            'msg' => 'Album restored!',
        ]);
    }

    /**
     *
     * Восстановить фото из корзины
     *
     * @param Request $request
     * @param PhotoService $photoService
     * @return \Illuminate\Http\JsonResponse
     */
    public function restorePhoto(Request $request, PhotoService $photoService)
    {
        $photo = Photo::withTrashed()->find($request->get('photoId'));
        $photoService->restorePhoto($photo);

        return response()->json([
            'msg' => 'Photo restored!',
        ]);
    }


}
