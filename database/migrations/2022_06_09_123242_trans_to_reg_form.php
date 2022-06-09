<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TransToRegForm extends Migration
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
            'key' => 'subject',
            'text' => [
                'ru' => 'Регистрация',
                'en' => 'Registration'
            ],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'subject-label',
            'text' => [
                'ru' => 'Завершите регистрацию, чтобы начать пользоваться нашим сервисом',
                'en' => 'Complete registration to start using our service'
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
