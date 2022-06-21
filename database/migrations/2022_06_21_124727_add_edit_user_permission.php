<?php

use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddEditUserPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $editUser = 'edit_user_data';
        $editUserPermission = null;
        if (!Permission::whereName($editUser)->first()) {
            $editUserPermission = Permission::create([
                'name' => $editUser,
                'description' => 'Edit user data in admin',
            ]);
        }

        $adminRole = Role::whereName(Role::ROLE_ADMIN)->first();

        $insertPermissionRole[] = [
            'role_id' => $adminRole->id,
            'permission_id' => $editUserPermission->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        DB::table('role_permissions')->insert($insertPermissionRole);

        $roleService = new RoleService();
        $adminUsers = $roleService->getAdministrators();

        foreach ($adminUsers as $adminUser) {
            $insertPermissionUser[] = [
                'user_id' => $adminUser->id,
                'permission_id' => $editUserPermission->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('user_permissions')->insert($insertPermissionUser);
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
