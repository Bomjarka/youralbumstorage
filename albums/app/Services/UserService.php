<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function editData($userData, User $user)
    {
        $user->login = $userData['login'];
        $user->first_name = $userData['firstName'];
        $user->second_name = $userData['secondName'];
        $user->lastName = $userData['lastName'];
        $user->sex = $userData['gender'];
        $user->phone = $userData['phone'];
        $user->email = $userData['email'];
        $user->birthdate = $userData['birthdate'];

        $user->save();
    }

    public function block(User $user)
    {
        $user->is_blocked = true;
        $user->save();
    }

    public function unblock(User $user)
    {
        $user->is_blocked = false;
        $user->save();
    }
}
