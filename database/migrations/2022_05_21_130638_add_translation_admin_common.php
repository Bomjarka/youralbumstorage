<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationAdminCommon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-common',
            'key' => 'index',
            'text' => ['ru' => 'Главная', 'en' => 'Index'],
        ]);

        LanguageLine::create([
            'group' => 'admin-common',
            'key' => 'title',
            'text' => ['ru' => 'Главная страница панели управления', 'en' => 'Admin Index Page'],
        ]);

        LanguageLine::create([
            'group' => 'admin-common',
            'key' => 'greeting',
            'text' => ['ru' => 'Вы', 'en' => 'You are'],
        ]);

        LanguageLine::create([
            'group' => 'admin-common',
            'key' => 'copyright',
            'text' => ['ru' => 'Вы', 'en' => 'You are'],
        ]);

        LanguageLine::create([
            'group' => 'admin-common',
            'key' => 'ability-message',
            'text' => ['ru' => 'Панель управления недоступна с мобильных устройств', 'en' => 'Admin panel available only from Desktop'],
        ]);

        //Боковая панель
        LanguageLine::create([
            'group' => 'admin-common',
            'key' => 'admin-tools',
            'text' => ['ru' => 'Панель инструментов', 'en' => 'Admin tools'],
        ]);

        LanguageLine::create([
            'group' => 'admin-menu',
            'key' => 'dashboard',
            'text' => ['ru' => 'Графики', 'en' => 'Dashboard'],
        ]);

        LanguageLine::create([
            'group' => 'admin-menu',
            'key' => 'users',
            'text' => ['ru' => 'Пользователи', 'en' => 'Users'],
        ]);

        LanguageLine::create([
            'group' => 'admin-menu',
            'key' => 'roles',
            'text' => ['ru' => 'Роли', 'en' => 'Roles'],
        ]);

        //Выпадающее меню
        LanguageLine::create([
            'group' => 'admin-dropdown-menu',
            'key' => 'back-to-app',
            'text' => ['ru' => 'Вернуться в приложение', 'en' => 'Back to app'],
        ]);

        LanguageLine::create([
            'group' => 'admin-dropdown-menu',
            'key' => 'profile',
            'text' => ['ru' => 'Профиль', 'en' => 'Profile'],
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
