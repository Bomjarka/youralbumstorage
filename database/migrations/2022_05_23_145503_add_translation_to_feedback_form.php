<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToFeedbackForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'feedback-form',
            'key' => 'title',
            'text' => ['ru' => 'Форма обратной связи', 'en' => 'Contact form'],
        ]);

        LanguageLine::create([
            'group' => 'feedback-form',
            'key' => 'name-label',
            'text' => ['ru' => 'Ваше имя', 'en' => 'Your name'],
        ]);

        LanguageLine::create([
            'group' => 'feedback-form',
            'key' => 'email-label',
            'text' => ['ru' => 'Ваша почта', 'en' => 'Your email'],
        ]);

        LanguageLine::create([
            'group' => 'feedback-form',
            'key' => 'message-label',
            'text' => ['ru' => 'Обращение', 'en' => 'Message'],
        ]);

        LanguageLine::create([
            'group' => 'feedback-form',
            'key' => 'message-placeholder',
            'text' => ['ru' => 'Ваше сообщение', 'en' => 'Your message'],
        ]);

        LanguageLine::create([
            'group' => 'feedback-form',
            'key' => 'submit-button',
            'text' => ['ru' => 'Отправить обращение', 'en' => 'Submit'],
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
