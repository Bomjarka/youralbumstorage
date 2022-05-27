<?php

namespace App\Rules\Registration;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class UserAgeRule implements Rule
{

    public const MIN_AGE = 14;

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
    public function passes($attribute, $value): bool
    {
        $date = new Carbon($value);

        return $date->diffInYears(Carbon::now()->toDate()) >= self::MIN_AGE ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation-registration.birthdate', ['age' => self::MIN_AGE]);
    }
}
