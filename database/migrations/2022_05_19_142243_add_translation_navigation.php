<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationNavigation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'albums',
            'text' => ['ru' => 'Альбомы', 'en' => 'Photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'photos',
            'text' => ['ru' => 'Фотографии', 'en' => 'Photos'],
        ]);

        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'about',
            'text' => ['ru' => 'О сервисе', 'en' => 'About'],
        ]);

        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'profile',
            'text' => ['ru' => 'Профиль', 'en' => 'Profile'],
        ]);

        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'logout',
            'text' => ['ru' => 'Выйти', 'en' => 'Log Out'],
        ]);

        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'register',
            'text' => ['ru' => 'Зарегистрироваться', 'en' => 'Register'],
        ]);

        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'login',
            'text' => ['ru' => 'Войти', 'en' => 'Log In'],
        ]);

        LanguageLine::create([
            'group' => 'view-navigation',
            'key' => 'guest',
            'text' => ['ru' => 'Гость', 'en' => 'Guest'],
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
