<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationUserBlockedBlade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'userblocked-blade',
            'key' => 'message',
            'text' => ['ru' => 'К сожалению, ваш профиль был заблокирован', 'en' => 'Unfortunately your account was blocked.'],
        ]);

        LanguageLine::create([
            'group' => 'userblocked-blade',
            'key' => 'action',
            'text' => ['ru' => 'Нажмите на эту ссылку, чтобы связаться с нами.', 'en' => 'Click here to contact us to clarify the reasons.'],
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
