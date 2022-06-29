<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TranslateForExpiredLinkPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'link-expired-blade',
            'key' => 'message',
            'text' => ['ru' => 'К сожалению, срок действия ссылки истёк, запросите новую ссылку', 'en' => 'Unfortunately your link has expired, request new link please.'],
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
