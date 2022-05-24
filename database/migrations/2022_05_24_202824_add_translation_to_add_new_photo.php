<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToAddNewPhoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'title',
            'text' => ['ru' => 'Добавить новую фотографию', 'en' => 'Add new photo'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'title-description',
            'text' => ['ru' => 'Добавьте новую фотографию в своё хранилище', 'en' => 'Add new photo to your storage'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'attachment-label',
            'text' => ['ru' => 'Файлы', 'en' => 'Attachments'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'attachment-text',
            'text' => ['ru' => 'Переместите свой файл сюда', 'en' => 'Attach tour file here'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'accepted-files',
            'text' => ['ru' => 'Доступные типы файлов', 'en' => 'Accepted File Types'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'options',
            'text' => ['ru' => 'дополнительно', 'en' => 'options'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'to-album',
            'text' => ['ru' => 'Добавить фото к альбому', 'en' => 'Add photo to album'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
            'key' => 'choose-album',
            'text' => ['ru' => 'Выбрать альбом', 'en' => 'Choose album'],
        ]);

        LanguageLine::create([
            'group' => 'add-photo-form',
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
