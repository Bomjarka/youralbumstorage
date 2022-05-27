<?php

namespace App\Services\Registration;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserData
{
    public static function prepareData(Request $request): array
    {
        $userData = [
            'login' => $request->login,
            'email' => Str::lower($request->email),
            'password' => Hash::make($request->password),
            'first_name' => Str::lower($request->first_name),
            'second_name' => Str::lower($request->second_name),
            'last_name' => Str::lower($request->last_name),
            'phone' => $request->phone,
            'sex' => $request->gender,
            'birthdate' => Carbon::parse($request->birthdate),
        ];

        return $userData;
    }

}
