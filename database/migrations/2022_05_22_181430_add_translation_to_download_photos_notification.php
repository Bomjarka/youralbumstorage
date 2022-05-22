<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToDownloadPhotosNotification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'download-photos-notification',
            'key' => 'message',
            'text' => [
                'ru' => 'Проверьте свою почту, мы выслали ссылку на скачивание архива с фотографиями',
                'en' => 'Check your email, we sent link for downloading archive'
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
