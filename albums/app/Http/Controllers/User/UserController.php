<?php
namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('user.albums');
    }

    public function profile()
    {
        return view('user.profile');
    }
}
