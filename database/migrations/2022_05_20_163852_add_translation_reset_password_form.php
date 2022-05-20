<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationResetPasswordForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'form-reset-password',
            'key' => 'email',
            'text' => ['ru' => 'Почта', 'en' => 'Email'],
        ]);

        LanguageLine::create([
            'group' => 'form-reset-password',
            'key' => 'password',
            'text' => ['ru' => 'Пароль', 'en' => 'Password'],
        ]);

        LanguageLine::create([
            'group' => 'form-reset-password',
            'key' => 'confirm-pwd',
            'text' => ['ru' => 'Подтвердите пароль', 'en' => 'Confirm password'],
        ]);

        LanguageLine::create([
            'group' => 'form-reset-password',
            'key' => 'reset-pwd',
            'text' => ['ru' => 'Сменить пароль', 'en' => 'Reset password'],
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
