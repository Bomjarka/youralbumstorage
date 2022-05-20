<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationRegisterForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'login',
            'text' => ['ru' => 'Логин', 'en' => 'Login'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'firstname',
            'text' => ['ru' => 'Имя', 'en' => 'First Name'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'secondname',
            'text' => ['ru' => 'Отчество', 'en' => 'Second Name'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'lastname',
            'text' => ['ru' => 'Фамилия', 'en' => 'Last Name'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'email',
            'text' => ['ru' => 'Почта', 'en' => 'Email'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'phone',
            'text' => ['ru' => 'Телефон', 'en' => 'Phone'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'sex',
            'text' => ['ru' => 'Пол', 'en' => 'Gender'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'birthdate',
            'text' => ['ru' => 'Дата рождения', 'en' => 'Birthdate'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'password',
            'text' => ['ru' => 'Пароль', 'en' => 'Password'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'confirm-pwd',
            'text' => ['ru' => 'Повторите пароль', 'en' => 'Confirm Password'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'already-registered',
            'text' => ['ru' => 'Уже зарегистрированы?', 'en' => 'Already registered?'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'register',
            'text' => ['ru' => 'Зарегистрироваться', 'en' => 'Register'],
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
