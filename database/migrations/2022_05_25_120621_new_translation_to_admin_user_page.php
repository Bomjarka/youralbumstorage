<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class NewTranslationToAdminUserPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-user-page-admin-actions',
            'key' => 'delete-user',
            'text' => ['ru' => 'Удалить пользователя', 'en' => 'Delete user'],
        ]);

        LanguageLine::create([
            'group' => 'admin-user-page-admin-actions',
            'key' => 'delete-acceptance',
            'text' => ['ru' => 'Заблокировать пользователя', 'en' => 'Block user'],
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
