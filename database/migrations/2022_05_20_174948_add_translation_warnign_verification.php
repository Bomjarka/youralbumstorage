<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationWarnignVerification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'warning-blade',
            'key' => 'title',
            'text' => ['ru' => 'Предупреждение', 'en' => 'Warning'],
        ]);

        LanguageLine::create([
            'group' => 'warning-blade',
            'key' => 'subject',
            'text' => ['ru' => 'Вы не подтвердили почту', 'en' => 'You are not verified!'],
        ]);

        LanguageLine::create([
            'group' => 'warning-blade',
            'key' => 'message',
            'text' => ['ru' => 'Нажмите здесь чтобы подтвердить свою почту', 'en' => 'Click here to verify your profile'],
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
