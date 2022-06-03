<?php

namespace Tests\Feature\Moderator;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ModeratorPermissionsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     *
     * @return void
     */
    public function test_moderator_can_edit_permission(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);

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
