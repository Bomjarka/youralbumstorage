<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\User\UserController;
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

    //Нажатие на кнопку скачивания фото
    Route::post('/download_all_photos', [PhotoController::class, 'downloadAllPhotos'])->name('downloadAllPhotos');
    //скачивание архива с фотографиями
    Route::get('/download/{filename}', [PhotoController::class, 'download'])
        ->middleware(['signed'])
        ->name('download');
});





