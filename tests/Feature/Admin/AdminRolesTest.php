<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminRolesTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     *
     * @return void
     */
    public function test_admin_can_edit_role(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);

        $role = Role::create([
            'name' => 'Test role',
            'description' => 'Test role description',
        ]);

        $data = [
            'roleId' => $role->id,
            'newRoleDescription' => 'Description edited by ' . $user->id,
        ];

        $this->actingAs($user);
        $response = $this->post('/admin/roles/edit', $data);

        $role->refresh();

        $this->assertEquals($role->description, 'Description edited by ' . $user->id);
        $response->assertSessionHas('status', 'role-updated');
        $response->assertStatus(302);
    }
}
