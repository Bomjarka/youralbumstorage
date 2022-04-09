<?php

use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__ . '/auth.php';
require __DIR__ . '/../app/Http/Routes/user.php';
require __DIR__ . '/../app/Http/Routes/guest.php';
require __DIR__ . '/../app/Http/Routes/common.php';
require __DIR__ . '/../app/Http/Routes/admin.php';

