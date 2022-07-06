<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class CaptchaTranslate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'captcha',
            'key' => 'text',
            'text' => ['ru' => 'Введите текст с картинки', 'en' => 'Print text from picture'],
        ]);

        LanguageLine::create([
            'group' => 'validation-captcha',
            'key' => 'failed',
            'text' => ['ru' => 'Вы неверно ввели символы с картинки, попробуйте ещё раз', 'en' => 'You print wrong captcha, please try again'],
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
