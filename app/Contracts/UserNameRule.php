<?php

namespace App\Contracts;

use Illuminate\Contracts\Validation\Rule;

interface UserNameRule extends Rule
{
    //содержит только буквы без пробелов и других символов
    const NAME_PATTERN = "/(^[а-яёА-ЯЁa-zA-z])([а-яёА-ЯЁa-zA-z]+)*$/";

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value);

    public function checkInputVale($value);

    public function message();
}
