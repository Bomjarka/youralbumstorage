<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationVerifyEmailMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'verify-email-message',
            'key' => 'subject',
            'text' => ['ru' => 'Подтверждение электронной почты', 'en' => 'Verify Email Address'],
        ]);

        LanguageLine::create([
            'group' => 'verify-email-message',
            'key' => 'greeting',
            'text' => ['ru' => 'Приветствуем', 'en' => 'Hello'],
        ]);

        LanguageLine::create([
            'group' => 'verify-email-message',
            'key' => 'regards',
            'text' => ['ru' => 'С уважением', 'en' => 'Regards'],
        ]);

        LanguageLine::create([
            'group' => 'verify-email-message',
            'key' => 'message',
            'text' => [
                'ru' => 'Нажмите на ссылку ниже для того, чтобы подтвердить адрес электронной почты',
                'en' => 'Please click the button below to verify your email address'
            ],
        ]);

        LanguageLine::create([
            'group' => 'verify-email-message',
            'key' => 'action',
            'text' => ['ru' => 'Подтвердите электронную почту', 'en' => 'Verification of Email Address'],
        ]);

        LanguageLine::create([
            'group' => 'verify-email-message',
            'key' => 'warning',
            'text' => [
                'ru' => 'Если вы не создавали профиль на нашем сайте, то не нужно ничего делать',
                'en' => 'If you did not create an account, no further action is required'
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
