<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationForgotPasswordForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'form-forgot-password',
            'key' => 'message',
            'text' => [
                'ru' => 'Забыли пароль? Не переживайте, просто укажите вашу почту и мы вышлем вам письмо с данными для восстановления пароля',
                'en' => 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'form-forgot-password',
            'key' => 'email',
            'text' => ['ru' => 'Почта', 'en' => 'Email'],
        ]);

        LanguageLine::create([
            'group' => 'form-forgot-password',
            'key' => 'reset-link',
            'text' => ['ru' => 'Отправить ссылку письмо для восстановления пароля', 'en' => 'Email password reset link'],
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
