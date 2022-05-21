<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationAdminDashboard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-dashboard',
            'key' => 'registrations',
            'text' => ['ru' => 'Регистрации', 'en' => 'Registrations'],
        ]);

        LanguageLine::create([
            'group' => 'admin-dashboard',
            'key' => 'photos',
            'text' => ['ru' => 'Загрузки фотографий', 'en' => 'Photos uploaded'],
        ]);

        LanguageLine::create([
            'group' => 'admin-dashboard',
            'key' => 'days',
            'text' => ['ru' => 'дней', 'en' => 'days'],
        ]);

        LanguageLine::create([
            'group' => 'admin-dashboard',
            'key' => 'months',
            'text' => ['ru' => 'месяцев', 'en' => 'months'],
        ]);

        LanguageLine::create([
            'group' => 'admin-dashboard',
            'key' => 'year',
            'text' => ['ru' => 'год', 'en' => 'year'],
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
