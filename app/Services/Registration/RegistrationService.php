<?php

namespace App\Services\Registration;

use App\Models\User;

class RegistrationService
{
    /**
     * @param array $userData
     * @return mixed
     */
    public function registerUser(array $userData)
    {
        return User::create([
            'login' => $userData['login'],
            'email' => $userData['email'],
            'password' => $userData['password'],
            'first_name' => $userData['first_name'],
            'second_name' => $userData['second_name'],
            'last_name' => $userData['last_name'],
            'phone' => $userData['phone'],
            'sex' => $userData['sex'],
            'birthdate' => $userData['birthdate'],
            'is_verified' => false,
            'is_blocked' => false,
        ]);
    }

}
