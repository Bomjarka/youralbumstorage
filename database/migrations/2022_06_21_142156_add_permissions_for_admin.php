<?php

use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPermissionsForAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'add_permission_to_user' => 'Add permission to user',
            'remove_permission_from_user' => 'Remove permission from user',
        ];

        foreach ($permissions as $permissionName => $permissionDescription) {
            if (!Permission::whereName($permissionName)->first()) {
                Permission::create([
                    'name' => $permissionName,
                    'description' => $permissionDescription,
                ]);
            }
        }

        $addedPermissions = Permission::whereIn('name', ['add_permission_to_user', 'remove_permission_from_user'])->get();

        foreach ($addedPermissions as $addedPermission) {
            $adminRole = Role::whereName(Role::ROLE_ADMIN)->first();

            $insertPermissionRole = [
                'role_id' => $adminRole->id,
                'permission_id' => $addedPermission->id,
                'created_at' => \Illuminate\Support\Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            DB::table('role_permissions')->insert($insertPermissionRole);

            $roleService = new RoleService();
            $adminUsers = $roleService->getAdministrators();

            foreach ($adminUsers as $adminUser) {
                $insertPermissionUser = [
                    'user_id' => $adminUser->id,
                    'permission_id' => $addedPermission->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }

            DB::table('user_permissions')->insert($insertPermissionUser);
        }
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
