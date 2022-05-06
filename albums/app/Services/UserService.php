<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    /**
     * @param $userData
     * @param User $user
     * @return void
     */
    public function editData($userData, User $user): void
    {
        $user->login = $userData['login'];
        $user->first_name = $userData['firstName'];
        $user->second_name = $userData['secondName'];
        $user->last_name = $userData['lastName'];
        $user->sex = $userData['gender'];
        $user->phone = $userData['phone'];
        $user->email = $userData['email'];
        $user->birthdate = $userData['birthdate'];

        $user->save();
    }

    /**
     * @param User $user
     * @return void
     */
    public function block(User $user): void
    {
        $user->is_blocked = true;
        $user->save();
    }

    /**
     * @param User $user
     * @return void
     */
    public function unblock(User $user): void
    {
        $user->is_blocked = false;
        $user->save();
    }
}
