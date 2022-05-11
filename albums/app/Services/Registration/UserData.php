<?php

namespace App\Services\Registration;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserData
{
    public static function prepareData(Request $request): array
    {
        $userData = [
            'login' => $request->login,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'sex' => $request->gender,
            'birthdate' => Carbon::parse($request->birthdate),
        ];

        return $userData;
    }

}
