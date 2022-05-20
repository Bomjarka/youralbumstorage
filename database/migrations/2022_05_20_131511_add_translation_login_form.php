<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationLoginForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'form-login',
            'key' => 'login',
            'text' => ['ru' => 'Логин', 'en' => 'Login'],
        ]);

        LanguageLine::create([
            'group' => 'form-login',
            'key' => 'password',
            'text' => ['ru' => 'Пароль', 'en' => 'Password'],
        ]);

        LanguageLine::create([
            'group' => 'form-login',
            'key' => 'remember',
            'text' => ['ru' => 'Запомнить меня', 'en' => 'Remember me'],
        ]);

        LanguageLine::create([
            'group' => 'form-login',
            'key' => 'forgot-pwd',
            'text' => ['ru' => 'Забыли пароль?', 'en' => 'Forgot your password?'],
        ]);

        LanguageLine::create([
            'group' => 'form-login',
            'key' => 'log-in',
            'text' => ['ru' => 'Войти', 'en' => 'LOG IN'],
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
