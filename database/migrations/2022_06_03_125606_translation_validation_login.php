<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TranslationValidationLogin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'validation-login',
            'key' => 'failed',
            'text' => [
                'ru' => 'Указанные вами данные не верны.',
                'en' => 'These credentials do not match our records.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-login',
            'key' => 'password',
            'text' => [
                'ru' => 'Введённый пароль неверен',
                'en' => 'The provided password is incorrect.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'validation-login',
            'key' => 'throttle',
            'text' => [
                'ru' => 'Количество попыток входа превышено. Попробуйте снова через :seconds секунд.',
                'en' => 'Too many login attempts. Please try again in :seconds seconds.'
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
        //
    }
}
