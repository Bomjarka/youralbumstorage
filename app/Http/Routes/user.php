<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/**
 * Маршруты для пользователей
 */
Route::middleware(['userblocked', 'auth'])->group(function () {

    //Страница профиль
    Route::prefix('profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::post('/edit', [UserController::class, 'edit'])->name('editUserProfile');

        Route::post('/trash/albums', [UserController::class, 'restoreAlbum'])->name('restoreAlbum');

        Route::post('/trash/photos', [UserController::class, 'restorePhoto'])->name('restorePhoto');

        Route::post('/albums_and_photos', [PhotoController::class, 'downloadAllPhotos'])->name('downloadAllPhotos');

        Route::get('/download/{filename}', [PhotoController::class, 'download'])->name('download');
    });

    //Страница с галлереей
    Route::get('/gallery', function () {
        return view('user.gallery');
    })->name('gallery');

    //Страница с фотографиями пользователя
    Route::prefix('photos')->group(function () {
        Route::get('/{photo}', [PageController::class, 'photos'])->name('userPhotos');
        Route::post('/create', [PhotoController::class, 'create'])->name('createPhoto');

        Route::post('/{photo}/edit', [PhotoController::class, 'edit'])->name('editPhoto');

        Route::post('/{photo}/delete', [PhotoController::class, 'delete'])->name('deletePhoto');
    });

    //Страница с альбомами пользователя
    Route::prefix('albums')->group(function () {
        Route::get('/{album}', [AlbumController::class, 'album'])->name('userAlbum');

        Route::post('/create', [AlbumController::class, 'create'])
            ->name('createAlbum');

        Route::post('/{album}/edit', [AlbumController::class, 'edit'])
            ->name('editAlbum');

        Route::post('/{album}/delete', [AlbumController::class, 'delete'])
            ->name('deleteAlbum');

        Route::post('/{album}/{photo}/delete', [PhotoController::class, 'delete'])
            ->name('deletePhotoFromAlbum');
    });

    //Смена языка
    Route::get('locale/{locale}', function ($locale) {
        if (!in_array($locale, ['en', 'ru'])) {
            abort(404);
        }

        App::setLocale($locale);
        // Session
        session()->put('locale', $locale);

        return redirect()->back();
    })->name('changeLocale');
});





