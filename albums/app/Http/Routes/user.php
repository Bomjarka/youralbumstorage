<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Маршруты для пользователей
 */
Route::middleware('userblocked')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])
        ->middleware(['auth'])->name('profile');

    Route::prefix('profile')->group(function () {
        Route::post('/edit', [UserController::class, 'edit'])
            ->middleware(['auth'])->name('editUserProfile');

        Route::post('/trash/albums', [AlbumController::class, 'restoreAlbum'])
            ->middleware(['auth'])->name('restoreAlbum');

        Route::post('/trash/photos', [PhotoController::class, 'restorePhoto'])
            ->middleware(['auth'])->name('restorePhoto');
    });

    Route::prefix('photos')->group(function () {

        Route::middleware('userverified')->group(function () {
            Route::get('/{photo}', [PageController::class, 'photos'])
                ->middleware(['auth'])->name('userPhotos');
            Route::post('/create', [PhotoController::class, 'create'])
                ->middleware(['auth'])->name('createPhoto');

            Route::post('/{photo}/edit', [PhotoController::class, 'edit'])
                ->middleware(['auth'])->name('editPhoto');

            Route::post('/{photo}/delete', [PhotoController::class, 'delete'])
                ->middleware(['auth'])->name('deletePhoto');
        });
    });

    Route::prefix('albums')->group(function () {
        Route::middleware('userverified')->group(function () {
            Route::get('/{album}', [AlbumController::class, 'index'])
                ->middleware(['auth'])->name('userAlbum');

            Route::post('/create', [AlbumController::class, 'create'])
                ->middleware(['auth'])->name('createAlbum');

            Route::post('/{album}/edit', [AlbumController::class, 'edit'])
                ->middleware(['auth'])->name('editAlbum');

            Route::post('/{album}/delete', [AlbumController::class, 'delete'])
                ->middleware(['auth'])->name('deleteAlbum');

            Route::post('/{album}/{photo}/delete', [PhotoController::class, 'delete'])
                ->middleware(['auth'])->name('deletePhotoFromAlbum');
        });
    });
});





