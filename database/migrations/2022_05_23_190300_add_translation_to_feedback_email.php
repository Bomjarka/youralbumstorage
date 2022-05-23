<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToFeedbackEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'feedback-email',
            'key' => 'title',
            'text' => [
                'ru' => 'Обратная связь от',
                'en' => "Feedback from"
            ],
        ]);

        LanguageLine::create([
            'group' => 'feedback-email',
            'key' => 'link-to-user',
            'text' => [
                'ru' => 'Ссылка на пользователя в администраторской панели',
                'en' => "Link to user in admin panel"
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
