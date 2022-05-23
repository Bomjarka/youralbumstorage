<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class NewTranslationToRegisterForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'phone-help',
            'text' => ['ru' => '11 цифр начиная с 8, без использования +', 'en' => '11 numbers starts with 8, without +'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'password-help-length',
            'text' => ['ru' => 'Минимальная длина пароля 8 символов', 'en' => 'Minimum size of the password is 8'],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'password-help-case',
            'text' => [
                'ru' => 'Необходимо использовать как минимум по одному заглавному и строчному символу',
                'en' => 'At least one uppercase and one lowercase letter'
            ],
        ]);

        LanguageLine::create([
            'group' => 'form-register',
            'key' => 'password-help-numbers',
            'text' => [
                'ru' => 'Необходимо использовать как минимум одну цифру',
                'en' => 'At least one number'
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
