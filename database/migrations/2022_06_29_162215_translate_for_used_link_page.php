<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TranslateForUsedLinkPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'link-already-used',
            'key' => 'message',
            'text' => ['ru' => 'К сожалению, вы уже использовали данную ссылку, запросите новую', 'en' => 'Unfortunately you have been already used this link, request a new one please.'],
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
