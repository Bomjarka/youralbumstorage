<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class NewTranslationVerifyEmail extends Migration
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
            'key' => 'success-message',
            'text' => [
                'ru' => 'Мы отправили письмо с ссылкой для авторизации на вашу почту',
                'en' => 'A new verification link has been sent to the email address you provided during registration.'
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
