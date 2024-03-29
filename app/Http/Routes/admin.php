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

        Route::prefix('dashboard')->group(function () {
            Route::get('/', [AdminController::class, 'dashboard'])->name('adminDashboard');
            Route::post('/', [AdminController::class, 'dashboardPeriod'])->name('adminDashboardPeriod');
        });

        Route::get('/users', [AdminController::class, 'users'])->name('adminUsers');

        Route::get('/users/{user}', [AdminController::class, 'user'])->name('adminUser');

        Route::prefix('/users/{user}')->group(function () {
            Route::post('/edit', [AdminController::class, 'editUser'])->name('editUser');
            Route::post('/block', [AdminController::class, 'blockUser'])->name('blockUser');
            Route::post('/unblock', [AdminController::class, 'unblockUser'])->name('unblockUser');
            Route::post('/add_role', [AdminController::class, 'addUserRole'])->name('addUserRole');
            Route::post('/remove_role', [AdminController::class, 'removeUserRole'])->name('removeUserRole');
            Route::post('/add_permission', [AdminController::class, 'addUserPermission'])->name('addUserPermission');
            Route::post('/remove_permission', [AdminController::class, 'removeUserPermission'])->name('removeUserPermission');
            Route::post('/delete_user', [AdminController::class, 'deleteUser'])->name('deleteUser');
        });

        Route::prefix('/roles')->group(function () {
            Route::get('/', [AdminController::class, 'roles'])->name('adminRoles');
            Route::post('/edit', [AdminController::class, 'editRole'])->name('editRole');
        });

        Route::prefix('/permissions')->group(function () {
            Route::get('/', [AdminController::class, 'permissions'])->name('adminPermissions');
            Route::post('/edit', [AdminController::class, 'editPermission'])->name('editPermission');
        });

        Route::get('/forms', function () {
            return view('admin.forms');
        })->name('adminForms');

        Route::get('/calendar', function () {
            return view('admin.calendar');
        })->name('adminCalendar');
    });
});


