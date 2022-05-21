<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationAdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'allroles',
            'text' => ['ru' => 'Все роли', 'en' => 'All roles'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'new-role-button',
            'text' => ['ru' => 'Добавить роль', 'en' => 'Add role'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'new-role-title',
            'text' => ['ru' => 'Добавить новую роль', 'en' => 'Add new role'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'new-role-name',
            'text' => ['ru' => 'Имя роли', 'en' => 'Role name'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'new-role-description-label',
            'text' => ['ru' => 'Описание роли', 'en' => 'Role description'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'new-role-description-placeholder',
            'text' => ['ru' => 'Новая роль необходимая для...', 'en' => 'New role for...'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'save-role',
            'text' => ['ru' => 'Сохранить роль', 'en' => 'Save role'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'update-role',
            'text' => ['ru' => 'Обновить роль', 'en' => 'Update role'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'nothing-update',
            'text' => ['ru' => 'Нет полей для обновления', 'en' => 'Nothing to update'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'role-updated',
            'text' => ['ru' => 'Роль обновлена', 'en' => 'Role updated'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'role-created',
            'text' => ['ru' => 'Новая роль добавлена', 'en' => 'New role created'],
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
