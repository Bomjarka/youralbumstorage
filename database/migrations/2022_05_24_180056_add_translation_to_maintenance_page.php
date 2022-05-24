<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class AddTranslationToMaintenancePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'maintenance-page',
            'key' => 'header',
            'text' => [
                'ru' => 'Мы скоро вернёмся!',
                'en' => 'We’ll be back soon!'
            ],
        ]);

        LanguageLine::create([
            'group' => 'maintenance-page',
            'key' => 'message',
            'text' => [
                'ru' => 'Приносим извинения за неудобства, но в данный момент мы проводим техническое обслуживание. Если вам что-то нужно, вы всегда можете связаться с нами!',
                'en' => 'Sorry for the inconvenience but we’re performing some maintenance at the moment. If you need to you can always contact us, otherwise we’ll be back online shortly!'
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
