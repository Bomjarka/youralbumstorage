<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class DeletedUserTranslationNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'deleted-user-notification',
            'key' => 'subject',
            'text' => [
                'ru' => 'Предупреждение об удалении',
                'en' => 'Deletion warning'
            ],
        ]);

        LanguageLine::create([
            'group' => 'deleted-user-notification',
            'key' => 'message',
            'text' => [
                'ru' => 'Ваш аккаунт был удалён с нашего сайта.',
                'en' => 'Your account was deleted from our website.'
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
