<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class DownloadPhotoEmailTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'download-photo-email-message',
            'key' => 'subject',
            'text' => [
                'ru' => 'Скачивание фотографий',
                'en' => 'Downloading photos'
            ],
        ]);

        LanguageLine::create([
            'group' => 'download-photo-email-message',
            'key' => 'message',
            'text' => [
                'ru' => 'Вы получили это письмо, т.к. мы получили ваш запрос на загрузку всех фотографий.',
                'en' => 'You are receiving this email because we received a request for downloading all photos from you.'
            ],
        ]);

        LanguageLine::create([
            'group' => 'download-photo-email-message',
            'key' => 'action',
            'text' => [
                'ru' => 'Нажмите сюда, чтобы скачать архив с вашими фотографиями',
                'en' => 'Click here to download archive with your photos'
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
