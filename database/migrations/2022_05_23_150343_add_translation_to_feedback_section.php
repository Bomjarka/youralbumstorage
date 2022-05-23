<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToFeedbackSection extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'feedback-section',
            'key' => 'title',
            'text' => ['ru' => 'Свяжитесь с нами', 'en' => 'Contact us'],
        ]);

        LanguageLine::create([
            'group' => 'feedback-section',
            'key' => 'title-question',
            'text' => ['ru' => 'Остались вопросы? Будем рады помочь вам.', 'en' => "Have any questions? We'd love to hear from you."],
        ]);

        LanguageLine::create([
            'group' => 'feedback-section',
            'key' => 'help-support-title',
            'text' => ['ru' => 'Помощь & Поддержка', 'en' => "Help & Support"],
        ]);

        LanguageLine::create([
            'group' => 'feedback-section',
            'key' => 'help-support',
            'text' => [
                'ru' => 'Наша служба поддержки постарается помочь вам как можно быстрее.',
                'en' => "Our support team will help you as soon as possible."],
        ]);

        LanguageLine::create([
            'group' => 'feedback-section',
            'key' => 'contact-us-button',
            'text' => [
                'ru' => 'Связаться с нами',
                'en' => "Contact us"],
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
