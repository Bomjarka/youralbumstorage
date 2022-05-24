<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToResetPasswordNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'reset-password-notification',
            'key' => 'subject',
            'text' => [
                'ru' => 'Уведомление о Сбросе Пароля',
                'en' => 'Reset Password Notification'
            ],
        ]);

        LanguageLine::create([
            'group' => 'reset-password-notification',
            'key' => 'title',
            'text' => [
                'ru' => 'Вы получили это письмо, так как запросили восстановление пароля для вашего профиля.',
                'en' => 'You are receiving this email because we received a password reset request for your account.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'reset-password-notification',
            'key' => 'action',
            'text' => [
                'ru' => 'Сбросить пароль',
                'en' => 'Reset password'
            ],
        ]);

        LanguageLine::create([
            'group' => 'reset-password-notification',
            'key' => 'expire',
            'text' => [
                'ru' => 'Ссылка для сброса пароля перестанет работать через :count минут.',
                'en' => 'This password reset link will expire in :count minutes.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'reset-password-notification',
            'key' => 'no-action',
            'text' => [
                'ru' => 'Если вы не запрашивали сменю пароля, то ничего не нужно делать.',
                'en' => 'If you did not request a password reset, no further action is required.'
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
    }
}
