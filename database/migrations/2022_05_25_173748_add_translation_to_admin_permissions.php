<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToAdminPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'title',
            'text' => ['ru' => 'Привилегии', 'en' => 'Permissions'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'all-permissions',
            'text' => ['ru' => 'Все привилегии', 'en' => 'All permissions'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'create-permission-button',
            'text' => ['ru' => 'Добавить привилегии', 'en' => 'Add permission'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-name',
            'text' => ['ru' => 'Имя привилегии', 'en' => 'Permission name'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-description',
            'text' => ['ru' => 'Описание привилегии', 'en' => 'Permission description'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-action',
            'text' => ['ru' => 'Обновить привилегию', 'en' => 'Update permission'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'new-permission-title',
            'text' => ['ru' => 'Добавить новую привилегию', 'en' => 'Add new permission'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'save-permission',
            'text' => ['ru' => 'Сохранить привилегию', 'en' => 'Save permission'],
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
