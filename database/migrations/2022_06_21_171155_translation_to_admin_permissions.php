<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class TranslationToAdminPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-assigned',
            'text' => ['ru' => 'Привилегия назначена.', 'en' => 'Permission assigned'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-disabled',
            'text' => ['ru' => 'Привилегия отключена.', 'en' => 'Permission disabled'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-already-assigned',
            'text' => ['ru' => 'Привилегия уже назначена.', 'en' => 'Permission already assigned'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-assign-error',
            'text' => ['ru' => 'Ошибка при работе с привилегией', 'en' => 'Error with permission action'],
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
