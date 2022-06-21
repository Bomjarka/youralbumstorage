<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TranslationForPermissionsDiv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'title',
            'text' => [
                'ru' => 'Привилегии пользователя',
                'en' => 'User permissions'
            ],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'permissions-action-assign',
            'text' => [
                'ru' => 'Назначить привилегию',
                'en' => 'Assign permissions'
            ],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'no-permissions',
            'text' => [
                'ru' => 'Привилегии отсутствуют',
                'en' => 'No permissions'
            ],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'permission-name',
            'text' => [
                'ru' => 'Имя привилегии',
                'en' => 'Permission name'
            ],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'permission-description',
            'text' => [
                'ru' => 'Описание привилегии',
                'en' => 'Permission description'
            ],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'permission-action',
            'text' => [
                'ru' => 'Действие',
                'en' => 'Action'
            ],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'permission-action-remove',
            'text' => [
                'ru' => 'Снять привилегию',
                'en' => 'Remove permission'
            ],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-permissions',
            'key' => 'permission-action-choose',
            'text' => [
                'ru' => 'Выбрать привилегию',
                'en' => 'Choose permission'
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
        //
    }
}
