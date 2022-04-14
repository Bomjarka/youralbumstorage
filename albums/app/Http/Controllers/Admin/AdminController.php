<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleHelper;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminController extends Controller
{

    public function users()
    {
        $allUsers = User::orderBy('id')->get();
        return view('admin.users', ['users' => $allUsers]);
    }

    public function user(User $user)
    {
        return view('admin.user', ['user' => $user]);
    }

}
