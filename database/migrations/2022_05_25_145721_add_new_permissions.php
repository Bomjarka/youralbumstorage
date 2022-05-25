<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            'block_user' => 'Block user',
            'unblock_user' => 'Unblock user',
            'add_role_to_user' => 'Add role to user',
            'remove_role_from_user' => 'Remove role from user',
            'delete_user' => 'Delete user',
            'create_role' => 'Create new role',
            'edit_role' => 'Edit role',
        ];

        foreach ($permissions as $permissionName => $permissionDescription) {
            Permission::create([
                'name' => $permissionName,
                'description' => $permissionDescription,
            ]);
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
