<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Админ может блокировать пользователя
     *
     */
    public function test_admin_can_block_user(): void
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

    /**
     * Админ может разблокировать пользователя
     *
     */
    public function test_admin_can_unblock_user(): void
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

    /**
     * Админ может удалить пользователя
     *
     */
    public function test_admin_can_delete_user(): void
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

    /**
     * Админ может выдавать роль
     *
     */
    public function test_admin_can_give_user_a_role(): void
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


    /**
     * Админ может забирать роль
     *
     */
    public function test_admin_can_take_a_role_from_user(): void
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

    /**
     * @return void
     */
    public function test_admin_can_edit_user(): void
    {
        $admin = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $admin->id);

        $user = User::factory()->create(['is_blocked' => false]);

        $data = [
            'userId' => $user->id,
            'login' => 'New login',
            'firstName' => 'New name',
            'secondName' => 'New second name',
            'lastName' => 'New last name',
            'email' => 'new@mail.ru',
            'phone' => '81234567891',
            'gender' => 'male',
            'birthdate' => $user->birthdate,
        ];

        $this->actingAs($admin);

        $response = $this->post('/admin/users/' . $user->id . '/edit', $data);
        $user->refresh();

        $this->assertEquals($user->login, $data['login']);
        $this->assertEquals($user->first_name, $data['firstName']);
        $this->assertEquals($user->second_name, $data['secondName']);
        $this->assertEquals($user->last_name, $data['lastName']);
        $this->assertEquals($user->email, $data['email']);
        $this->assertEquals($user->phone, $data['phone']);
        $response->assertJson(['msg' => 'User data updated!']);
        $response->assertStatus(200);

    }
}
