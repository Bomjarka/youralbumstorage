<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TranslationValidation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'error-message',
            'text' => [
                'ru' => 'Ой! Что-то пошло не так.',
                'en' => 'Whoops! Something went wrong.
'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'first_name',
            'text' => [
                'ru' => 'Неверно указано имя',
                'en' => 'Invalid first name'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'second_name',
            'text' => [
                'ru' => 'Неверно указано отчество',
                'en' => 'Invalid second name'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'last_name',
            'text' => [
                'ru' => 'Неверно указана фамилия',
                'en' => 'Invalid last name'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'password-case',
            'text' => [
                'ru' => 'Необходимо использовать как минимум по одному заглавному и строчному символу',
                'en' => 'The password must contain at least one uppercase and one lowercase letter.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'password-symbols',
            'text' => [
                'ru' => 'Пароль должен содержать как минимум один символ',
                'en' => 'The password must contain at least one symbol.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'password-letter',
            'text' => [
                'ru' => 'Пароль должен содержать как минимум одну букву',
                'en' => 'The password must contain at least one letter.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'password-number',
            'text' => [
                'ru' => 'Пароль должен содержать как минимум одну цифру',
                'en' => 'The password must contain at least one number.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'password-length',
            'text' => [
                'ru' => 'Пароль должен быть минимум :length символов в длину',
                'en' => 'The password must be at least :length.'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
