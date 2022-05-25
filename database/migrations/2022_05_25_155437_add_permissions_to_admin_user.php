<?php

use App\Models\Role;
use App\Services\RoleService;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddPermissionsToAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_permissions', function($table) {
            $table->timestamps();
        });

        $roleService = new RoleService();
        $adminRole = Role::whereName(Role::ROLE_ADMIN)->first();
        $adminUsers = $roleService->getAdministrators();
        $adminPermissions = $roleService->getRolePermissions($adminRole->id);

        $insert = [];
        foreach ($adminUsers as $adminUser) {
            foreach ($adminPermissions as $adminPermission) {
                $insert[] = [
                    'user_id' => $adminUser->id,
                    'permission_id' => $adminPermission->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
        }
        DB::table('user_permissions')->insert($insert);
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
