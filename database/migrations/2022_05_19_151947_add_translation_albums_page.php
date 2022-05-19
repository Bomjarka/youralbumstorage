<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationAlbumsPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'view-albumpage',
            'key' => 'title',
            'text' => ['ru' => 'Ваши альбомы', 'en' => 'Your albums'],
        ]);

        LanguageLine::create([
            'group' => 'view-albumpage',
            'key' => 'album-name',
            'text' => ['ru' => 'Название альбома', 'en' => 'Album name'],
        ]);

        LanguageLine::create([
            'group' => 'view-albumpage',
            'key' => 'album-description',
            'text' => ['ru' => 'Описание альбома', 'en' => 'Album description'],
        ]);

        LanguageLine::create([
            'group' => 'view-albumpage-button',
            'key' => 'add-album',
            'text' => ['ru' => 'Новый альбом', 'en' => 'Add album'],
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
