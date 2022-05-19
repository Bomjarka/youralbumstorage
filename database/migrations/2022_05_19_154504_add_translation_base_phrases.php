<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationBasePhrases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'welcome',
            'text' => ['ru' => 'Добро пожаловать', 'en' => 'Welcome'],
        ]);

        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'created',
            'text' => ['ru' => 'Дата создания', 'en' => 'Created'],
        ]);

        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'deleted',
            'text' => ['ru' => 'Дата удаления', 'en' => 'Deleted'],
        ]);

        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'action',
            'text' => ['ru' => 'Действие', 'en' => 'Action'],
        ]);

        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'sex-male',
            'text' => ['ru' => 'мужской', 'en' => 'male'],
        ]);

        LanguageLine::create([
            'group' => 'base-phrases',
            'key' => 'sex-female',
            'text' => ['ru' => 'женский', 'en' => 'female'],
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
