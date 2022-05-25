<?php

use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPermissionsToAdminRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_permissions', function($table) {
            $table->timestamps();
        });

        $adminRole = Role::whereName(Role::ROLE_ADMIN)->first();

        $insert = [];
        $permissions = Permission::all();
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

    }
}
