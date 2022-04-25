<?php

use App\Models\User;
use App\Services\RoleService;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AddAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = User::create([
            'login' => 'admin',
            'email' => 'admin@albums.ru',
            'password' => Hash::make('Xamas123'),
            'first_name' => 'admin',
            'second_name' => 'admin',
            'last_name' => 'admin',
            'phone' => '89609213097',
            'sex' => 'male',
            'birthdate' => new Carbon('1996-10-27'),
            'is_verified' => true,
        ]);

        $rs = new RoleService();
        $rs->addRoleUser('admin', $user->id);
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
