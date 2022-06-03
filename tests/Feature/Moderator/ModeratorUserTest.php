<?php

namespace Tests\Feature\Moderator;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ModeratorUserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Админ может блокировать пользователя
     *
     */
    public function test_moderator_can_block_user(): void
    {
        $moderator = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $moderator->id);

        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($moderator);
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
    public function test_moderator_can_unblock_user(): void
    {
        $moderator = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $moderator->id);

        $user = User::factory()->create(['is_blocked' => true]);

        $this->actingAs($moderator);
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
    public function test_moderator_can_not_delete_user(): void
    {
        $moderator = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $moderator->id);

        $user = User::factory()->create(['is_blocked' => false]);

        $this->actingAs($moderator);
        $response = $this->post('/admin/users/' . $user->id . '/delete_user');
        $user->refresh();

        $this->assertModelExists($user);
        $response->assertJson([
            'status' => 'failed',
        ]);
        $response->assertStatus(200);
    }

    /**
     * Админ может выдавать роль
     *
     */
    public function test_moderator_can_give_user_a_role(): void
    {
        $moderator = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $moderator->id);

        $user = User::factory()->create(['is_blocked' => false]);
        $data = [
            'roleId' => Role::whereName(Role::ROLE_ADMIN)->first()->id,
        ];

        $this->actingAs($moderator);
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
    public function test_moderator_can_take_a_role_from_user(): void
    {
        $moderator = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $moderator->id);

        $user = User::factory()->create(['is_blocked' => false]);
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);
        $data = [
            'roleId' => Role::whereName(Role::ROLE_MODERATOR)->first()->id,
        ];

        $userRole = UserRole::whereUserId($user->id)
            ->whereRoleId(2)
            ->first();
        $this->assertNotNull($userRole);

        $this->actingAs($moderator);
        $response = $this->post('/admin/users/' . $user->id . '/remove_role', $data);

        $this->assertDeleted($userRole);
        $response->assertSessionHas('status', 'role-disabled');
        $response->assertStatus(302);
    }
}
