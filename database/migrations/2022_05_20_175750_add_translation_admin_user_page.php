<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationAdminUserPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Уведомления
        LanguageLine::create([
            'group' => 'admin-user-page-verify-warning',
            'key' => 'subject',
            'text' => ['ru' => 'Этот пользователь не верифицирован', 'en' => 'This user is not verified'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-blocked-alert',
            'key' => 'subject',
            'text' => ['ru' => 'Этот пользователь заблокирован', 'en' => 'This user is blocked'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-admin-info',
            'key' => 'subject',
            'text' => ['ru' => 'Этот пользователь является администратором', 'en' => 'This user is admin'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-data',
            'key' => 'about',
            'text' => ['ru' => 'О пользователе', 'en' => 'About'],
        ]);

        //Пользовательские роли
        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'title',
            'text' => ['ru' => 'Роли пользователя', 'en' => 'User roles'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'no-roles',
            'text' => ['ru' => 'Роли не назначены', 'en' => 'No roles'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'role-name',
            'text' => ['ru' => 'Имя роли', 'en' => 'Role name'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'role-description',
            'text' => ['ru' => 'Описание роли', 'en' => 'Role description'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'role-action',
            'text' => ['ru' => 'Действие', 'en' => 'Action'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'role-action-assign',
            'text' => ['ru' => 'Назначить роль', 'en' => 'Assign role'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'role-action-remove',
            'text' => ['ru' => 'Снять роль', 'en' => 'Remove role'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-user-roles',
            'key' => 'role-action-choose',
            'text' => ['ru' => 'Выберите роль', 'en' => 'Choose role'],
        ]);

        //Альбомы пользователя
        LanguageLine::create([
            'group' => 'admin-user-page-user-albums',
            'key' => 'not-in-album',
            'text' => ['ru' => 'Не в альбоме', 'en' => 'Not in album'],
        ]);

        //Действия администратора
        //Альбомы пользователя
        LanguageLine::create([
            'group' => 'admin-user-page-admin-actions',
            'key' => 'title',
            'text' => ['ru' => 'Действия', 'en' => 'Actions'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-admin-actions',
            'key' => 'block-user',
            'text' => ['ru' => 'Заблокировать пользователя', 'en' => 'Block user'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-admin-actions',
            'key' => 'unblock-user',
            'text' => ['ru' => 'Разблокировать пользователя', 'en' => 'Unblock user'],
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
