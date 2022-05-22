<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\TranslationLoader\LanguageLine;

class NewTranslationToAdminRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'role-assigned',
            'text' => ['ru' => 'Роль назначена.', 'en' => 'Role assigned'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'role-disabled',
            'text' => ['ru' => 'Роль снята с пользователя.', 'en' => 'Role disabled'],
        ]);

        LanguageLine::create([
            'group' => 'admin-roles',
            'key' => 'role-already-assigned',
            'text' => ['ru' => 'Роль назначена.', 'en' => 'Role assigned'],
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
