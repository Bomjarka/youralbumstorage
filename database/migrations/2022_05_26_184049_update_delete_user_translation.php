<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class UpdateDeleteUserTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::whereGroup('admin-user-page-admin-actions')
            ->where('key', 'delete-acceptance')
            ->first()
            ->update([
                'group' => 'admin-user-page-admin-actions',
                'key' => 'delete-acceptance',
                'text' => ['ru' => 'Удалить пользователя', 'en' => 'Delete user'],
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
