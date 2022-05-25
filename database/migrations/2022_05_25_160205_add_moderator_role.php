<?php

use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddModeratorRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::create([
            'name' => 'moderator',
            'description' => 'moderator of application'
        ]);

        $adminRole = Role::whereName(Role::ROLE_MODERATOR)->first();

        $insert = [];
        $permissions = Permission::where('name', '!=', Permission::DELETE_USER)->get();
        foreach ($permissions as $permission) {
            //Добавляем привилегии если они были установлены
            $insert[] = [
                'role_id' => $adminRole->id,
                'permission_id' => $permission->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('role_permissions')->insert($insert);
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
