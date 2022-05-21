<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationApprovingBlade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'approving-blade',
            'key' => 'title',
            'text' => ['ru' => 'Успех', 'en' => 'Success'],
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
