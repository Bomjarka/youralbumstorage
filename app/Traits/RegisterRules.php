<?php

namespace App\Traits;

use App\Rules\PasswordRules;
use App\Rules\UserNameRule;

trait RegisterRules
{
    protected function getRegisterRules()
    {
        return [
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255', new UserNameRule()],
            'second_name' => ['required', 'string', 'max:255', new UserNameRule()],
            'last_name' => ['required', 'string', 'max:255', new UserNameRule()],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
            'gender' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ];
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    protected function getUserNamemessages()
    {
        return [
            'first_name' => (string)trans('validation-registration.first_name'),
            'second_name' => (string)trans('validation-registration.second_name'),
            'last_name' => (string)trans('validation-registration.last_name')
        ];
    }
}
