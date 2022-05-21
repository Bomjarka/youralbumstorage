<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToBasePhrases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('base_phrases', function (Blueprint $table) {
            LanguageLine::create([
                'group' => 'base-phrases',
                'key' => 'without-albums',
                'text' => ['ru' => 'без альбомов', 'en' => 'without albums'],
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_phrases', function (Blueprint $table) {
            $langaugeLines = LanguageLine::where('group', 'base-phrases')
                ->where('key', 'without-albums');
            if ($langaugeLines) {
                $langaugeLines->delete();
            }
        });
    }
}
