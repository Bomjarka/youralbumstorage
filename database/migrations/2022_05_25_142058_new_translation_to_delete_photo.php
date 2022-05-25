<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class NewTranslationToDeletePhoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'delete-photo-form',
            'key' => 'title',
            'text' => ['ru' => 'Внимание', 'en' => 'Delete warning'],
        ]);

        LanguageLine::create([
            'group' => 'delete-photo-form',
            'key' => 'message',
            'text' => [
                'ru' => 'Вы уверены, что хотите удалить альбома? Данные будут храниться на сервер в течение :period дней',
                'en' => 'Are you sure you want to delete this? Data will be stored for :period days.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'delete-photo-form',
            'key' => 'delete-button',
            'text' => [
                'ru' => 'Удалить',
                'en' => 'Delete'
            ],
        ]);

        LanguageLine::create([
            'group' => 'delete-photo-form',
            'key' => 'cancel-button',
            'text' => [
                'ru' => 'Отменить',
                'en' => 'Cancel'
            ],
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
