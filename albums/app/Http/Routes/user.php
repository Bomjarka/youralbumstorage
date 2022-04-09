<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Маршруты для пользователей
 */

Route::get('/profile', [UserController::class, 'profile'])
    ->middleware(['auth'])->name('profile');


Route::prefix('photos')->group(function () {
    Route::get('/{photo}', [PageController::class, 'photos'])
        ->middleware(['auth'])->name('userPhoto');

    Route::post('/{photo}/delete', [PhotoController::class, 'delete'])
        ->middleware(['auth'])->name('deletePhoto');
});


Route::prefix('albums')->group(function () {
    Route::get('/{album}', [AlbumController::class, 'index'])
        ->middleware(['auth'])->name('userAlbum');

    Route::post('/{album}/delete', [AlbumController::class, 'delete'])
        ->middleware(['auth'])->name('deleteAlbum');

    Route::post('/{album}/{photo}/delete', [PhotoController::class, 'delete'])
        ->middleware(['auth'])->name('deletePhotoFromAlbum');
});



