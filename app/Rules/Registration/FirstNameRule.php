<?php

namespace App\Rules\Registration;

use App\Contracts\UserNameRule;

class FirstNameRule implements UserNameRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->checkInputVale($value);
    }

    /**
     * @param $value
     * @return bool
     */
    public function checkInputVale($value): bool
    {
        return (bool)preg_match(self::NAME_PATTERN, $value);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return (string)trans('validation-registration.first_name');
    }
}
