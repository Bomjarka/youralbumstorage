<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

/**
 * Общие маршруты для всех пользователей
 */

Route::get('/', [PageController::class, 'index'])->name('main');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/albums', [AlbumController::class, 'index'])->name('albums');

Route::get('/photos', [PhotoController::class, 'index'])->name('photos');
