<?php

namespace App\Services;

use App\Events\User\UserDeletionInitiated;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserService
{
    public function __construct()
    {

    }

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
    public function blockUser(User $user): void
    {
        $user->is_blocked = true;
        $user->save();
    }

    /**
     * @param User $user
     * @return void
     */
    public function unblockUser(User $user): void
    {
        $user->is_blocked = false;
        $user->save();
    }

    /**
     * Удаляем пользователя
     *
     * @param User $user
     */
    public function deleteUser(User $user): void
    {
        Log::info("Deleting user from system", [
            'user' => $user,
        ]);

        event(new UserDeletionInitiated($user));
    }
}
