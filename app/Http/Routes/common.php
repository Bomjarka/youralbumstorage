<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/**
 * Общие маршруты для всех пользователей
 */
Route::middleware(['userblocked'])->group(function () {
Route::get('/', [PageController::class, 'index'])->name('main');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/albums', [AlbumController::class, 'index'])->name('albums');

Route::get('/photos', [PhotoController::class, 'index'])->name('photos');

Route::post('/feedback', [PageController::class, 'feedback'])->name('feedback');

Route::get('/test', [PageController::class, 'refreshCaptcha'])->name('test');

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
