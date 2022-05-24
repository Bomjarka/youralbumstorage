<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToAddNewAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'add-album-form',
            'key' => 'title',
            'text' => ['ru' => 'Добавить новый альбом', 'en' => 'Add new album'],
        ]);

        LanguageLine::create([
            'group' => 'add-album-form',
            'key' => 'title-description',
            'text' => ['ru' => 'Добавьте новый альбом в своё хранилище', 'en' => 'Add new album to your storage'],
        ]);

        LanguageLine::create([
            'group' => 'add-album-form',
            'key' => 'button',
            'text' => ['ru' => 'Добавить', 'en' => 'Add'],
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
