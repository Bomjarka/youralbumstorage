<?php

namespace App\Rules\Registration;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class PhoneRule implements Rule
{
    public const PHONE_PATTER = "/(^[8])([0-9])+$/";

    public const PHONE_LENGTH = 11;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->checkPhone($value);
    }

    /**
     * @param $value
     * @return bool
     */
    private function checkPhone($value): bool
    {
        return (bool)preg_match(self::PHONE_PATTER, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */

    public function message(): string
    {
        return (string)trans('validation-registration.phone-symbols');
    }
}
