<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/**
 * Общие маршруты для всех пользователей
 */

Route::get('/', [PageController::class, 'index'])->name('main');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/albums', [PageController::class, 'albums'])->name('albums');

Route::get('/photos', [PageController::class, 'photos'])->name('photos');

