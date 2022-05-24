<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToEditPhotoForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'edit-photo-form',
            'key' => 'title',
            'text' => ['ru' => 'Редактировать фотографию', 'en' => 'Edit album'],
        ]);

        LanguageLine::create([
            'group' => 'edit-photo-form',
            'key' => 'description',
            'text' => [
                'ru' => 'Вы можете отредактировать название или описание. Нажмите кнопку сохранить после редактирования',
                'en' => 'You can change album name or description. Press save when finish.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'edit-photo-form',
            'key' => 'move-photo',
            'text' => [
                'ru' => 'Переместить фото в альбом',
                'en' => 'Move photo to album'
            ],
        ]);

        LanguageLine::create([
            'group' => 'edit-photo-form',
            'key' => 'save-button',
            'text' => [
                'ru' => 'Сохранить',
                'en' => 'Save'
            ],
        ]);

        LanguageLine::create([
            'group' => 'edit-photo-form',
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
