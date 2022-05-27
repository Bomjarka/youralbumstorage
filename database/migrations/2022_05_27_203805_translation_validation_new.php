<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TranslationValidationNew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // валидация телефона
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'phone',
            'text' => [
                'ru' => 'Неверно указан телефон',
                'en' => 'Invalid phone'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'phone-symbols',
            'text' => [
                'ru' => 'Номер телефона содержит неверные символы',
                'en' => 'Invalid phone number symbols'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'phone-length',
            'text' => [
                'ru' => 'Номер телефона должен состоять из :length цифр',
                'en' => 'Phone number should contain :length numbers'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'phone-unique',
            'text' => [
                'ru' => 'Номер телефона уже занят',
                'en' => 'The phone has already been taken'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'phone-required',
            'text' => [
                'ru' => 'Необходимо указать номер телефона',
                'en' => 'Phone number is required'
            ],
        ]);

        //Валидация логина
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'login-unique',
            'text' => [
                'ru' => 'Логин уже занят',
                'en' => 'The login has already been taken'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'login-required',
            'text' => [
                'ru' => 'Необходимо указать логин',
                'en' => 'Login is required'
            ],
        ]);

        //Валидация имени
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'first-name-required',
            'text' => [
                'ru' => 'Необходимо указать имя',
                'en' => 'First name number is required'
            ],
        ]);

        //Валидация отчества
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'second-name-required',
            'text' => [
                'ru' => 'Необходимо указать отчество',
                'en' => 'Second name number is required'
            ],
        ]);

        //Валидация фамилии
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'last-name-required',
            'text' => [
                'ru' => 'Необходимо указать фамилию',
                'en' => 'Last name number is required'
            ],
        ]);

        //Валидация почты
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'email-required',
            'text' => [
                'ru' => 'Необходимо указать почту',
                'en' => 'Email name number is required'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'email-unique',
            'text' => [
                'ru' => 'Почта уже занята',
                'en' => 'The email has already been taken'
            ],
        ]);

        //валидация возраста
        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'birthdate',
            'text' => [
                'ru' => 'Вам необходимо быть как минимум :age летним',
                'en' => 'You need to be at least :age years old'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-registration',
            'key' => 'birthdate-required',
            'text' => [
                'ru' => 'Необходимо указать дату рождения',
                'en' => 'Birthdate name number is required'
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
