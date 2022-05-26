<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class NewTransToPermissions extends Migration
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
            'key' => 'permission-created',
            'text' => ['ru' => 'Привилегия создана', 'en' => 'Permission created'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-updated',
            'text' => ['ru' => 'Привилегия обновлена', 'en' => 'Permission updated'],
        ]);

        LanguageLine::create([
            'group' => 'admin-permissions',
            'key' => 'permission-exists',
            'text' => ['ru' => 'Привилегия уже существует', 'en' => 'Permission exists'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'role-exists',
            'text' => ['ru' => 'Роль уже существует', 'en' => 'Role exists'],
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
