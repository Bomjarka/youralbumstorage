<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_block_user()
    {
        $admin = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $admin->id);

        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($admin);
        $response = $this->post('/admin/users/' . $user->id . '/block');
        $user->refresh();

        $this->assertTrue($user->isBlocked());
        $response->assertJson(['msg' => 'User blocked!']);
        $response->assertStatus(200);
    }

    public function test_admin_can_unblock_user()
    {
        $admin = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $admin->id);

        $user = User::factory()->create(['is_blocked' => true]);

        $this->actingAs($admin);
        $response = $this->post('/admin/users/' . $user->id . '/unblock');
        $user->refresh();

        $this->assertFalse($user->isBlocked());
        $response->assertJson(['msg' => 'User unblocked!']);
        $response->assertStatus(200);
    }

    public function test_admin_can_delete_user()
    {
        $admin = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $admin->id);

        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($admin);
        $response = $this->post('/admin/users/' . $user->id . '/delete_user');

        $this->assertDeleted($user);
        $response->assertJson([
            'status' => trans('approving-blade.title'),
            'redirect' => route('adminUsers')
        ]);
        $response->assertStatus(200);
    }

    public function test_admin_can_give_user_a_role()
    {
        $admin = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $admin->id);

        $user = User::factory()->create(['is_blocked' => false]);
        $data = [
            'roleId' => Role::whereName(Role::ROLE_ADMIN)->first()->id,
        ];

        $this->actingAs($admin);
        $response = $this->post('/admin/users/' . $user->id . '/add_role', $data);

        $this->assertNotEmpty($roleService->getUserRoles($user->id));
        $this->assertTrue($roleService->hasRole(Role::ROLE_ADMIN, $user->id));
        $response->assertSessionHas('status', 'role-assigned');
        $response->assertStatus(302);
    }

    public function test_admin_can_take_a_role_from_user()
    {
        $admin = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $admin->id);

        $user = User::factory()->create(['is_blocked' => false]);
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);
        $data = [
            'roleId' => Role::whereName(Role::ROLE_MODERATOR)->first()->id,
        ];

        $userRole = UserRole::whereUserId($user->id)
            ->whereRoleId(2)
            ->first();
        $this->assertNotNull($userRole);

        $this->actingAs($admin);
        $response = $this->post('/admin/users/' . $user->id . '/remove_role', $data);

        $this->assertDeleted($userRole);
        $response->assertSessionHas('status', 'role-disabled');
        $response->assertStatus(302);
    }
}
