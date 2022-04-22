<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/**
 * Маршруты для администратора
 */

Route::middleware(['userblocked', 'auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');

        Route::get('/blank', function () {
            return view('admin.blank');
        })->name('adminBlank');

        Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');

        Route::get('/users/{user}', [AdminController::class, 'user'])->name('adminUser');

        Route::prefix('/users/{user}')->group(function () {
            Route::post('/block', [AdminController::class, 'blockUser'])->name('blockUser');
            Route::post('/unblock', [AdminController::class, 'unblockUser'])->name('unblockUser');
            Route::post('/make_admin', [AdminController::class, 'makeAdmin'])->name('makeAdmin');
            Route::post('/disable_admin', [AdminController::class, 'disableAdmin'])->name('disableAdmin');
        });

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


