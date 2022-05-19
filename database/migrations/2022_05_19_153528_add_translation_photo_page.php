<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationPhotoPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'view-photospage',
            'key' => 'title',
            'text' => ['ru' => 'Ваши фотографии', 'en' => 'Your photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-photospage',
            'key' => 'photo-name',
            'text' => ['ru' => 'Название фотографии', 'en' => 'Photo name'],
        ]);

        LanguageLine::create([
            'group' => 'view-photospage',
            'key' => 'photo-description',
            'text' => ['ru' => 'Описание фотографии', 'en' => 'Photo description'],
        ]);

        LanguageLine::create([
            'group' => 'view-photospage-button',
            'key' => 'add-photo',
            'text' => ['ru' => 'Новая фотография', 'en' => 'Add photo'],
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
