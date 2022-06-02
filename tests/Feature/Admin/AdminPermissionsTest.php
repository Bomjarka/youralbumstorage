<?php

namespace Tests\Feature\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminPermissionsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_edit_permission()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);

        $permission = Permission::create([
            'name' => 'Test permisson',
            'description' => 'Test permisson description',
        ]);

        $data = [
            'permissionId' => $permission->id,
            'newPermissionDescription' => 'Description edited by ' . $user->id,
        ];

        $this->actingAs($user);
        $response = $this->post('/admin/permissions/edit', $data);

        $permission->refresh();

        $this->assertEquals($permission->description, 'Description edited by ' . $user->id);
        $response->assertSessionHas('status', 'permission-updated');
        $response->assertStatus(302);
    }
}
