<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/**
 * Маршруты для администратора
 */

Route::middleware('userblocked')->group(function () {
    Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('adminDashboard');

        Route::get('/blank', function () {
            return view('admin.blank');
        })->name('adminBlank');

        Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');

        Route::get('/users/{user}', [AdminController::class, 'user'])->name('adminUser');

        Route::get('/table', function () {
            return view('admin.table');
        })->name('adminTable');

        Route::get('/forms', function () {
            return view('admin.forms');
        })->name('adminForms');

        Route::get('/calendar', function () {
            return view('admin.calendar');
        })->name('adminCalendar');
    });
});
