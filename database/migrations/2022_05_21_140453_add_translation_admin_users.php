<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationAdminUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-users',
            'key' => 'allusers',
            'text' => ['ru' => 'Все пользователи', 'en' => 'All users'],
        ]);

        LanguageLine::create([
            'group' => 'admin-users',
            'key' => 'fullname',
            'text' => ['ru' => 'Полное имя', 'en' => 'Full name'],
        ]);

        LanguageLine::create([
            'group' => 'admin-users',
            'key' => 'blocked',
            'text' => ['ru' => 'Заблокирован', 'en' => 'Is blocked'],
        ]);

        LanguageLine::create([
            'group' => 'admin-users',
            'key' => 'verified',
            'text' => ['ru' => 'Верифицирован', 'en' => 'Is verified'],
        ]);

        //Добавление нескольких базовых фраз
        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'yes',
            'text' => ['ru' => 'Да', 'en' => 'Yes'],
        ]);

        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'no',
            'text' => ['ru' => 'Нет', 'en' => 'No'],
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
