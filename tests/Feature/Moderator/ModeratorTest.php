<?php

namespace Tests\Feature\Moderator;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ModeratorTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     *
     * @return void
     */
    public function test_moderator_can_view_admin(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin');
        $response->assertStatus(200);
    }

//    public function test_admin_can_view_dashboard()
//    {
//        $user = User::factory()->create(['is_blocked' => false]);
//        $roleService = new RoleService();
//        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);
//
//        $this->actingAs($user);
//
//        $response = $this->get('/admin/dashboard');
//        $response->assertStatus(200);
//    }

    /**
     * Модератор может просматривать всех пользователей
     *
     */
    public function test_moderator_can_view_users(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/users');
        $response->assertViewHas('users', $response->getOriginalContent()->getData()['users']);
        $response->assertStatus(200);
    }

    /**
     * Модератор может просматривать каждого пользователя
     *
     */
    public function test_moderator_can_view_user(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/users/' . $user->id);
        $response->assertViewHas('user', $user);
        $response->assertStatus(200);
    }

    /**
     * Модератор может просматривать роли
     *
     */
    public function test_moderator_can_view_roles(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/roles');
        $response->assertViewHas('roles', $response->getOriginalContent()->getData()['roles']);
        $response->assertStatus(200);
    }

    /**
     * Модератор может просматривать привилегии
     *
     */
    public function test_moderator_can_view_permissions(): void
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_MODERATOR, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/permissions');
        $response->assertViewHas('permissions', $response->getOriginalContent()->getData()['permissions']);
        $response->assertStatus(200);
    }

    public function test_moderator_change_locale_to_en(): void
    {
        $ruLocale = App::getLocale();
        $response = $this->get('/locale/en');

        $this->assertNotEquals($ruLocale, App::getLocale());
        $response->assertStatus(302);
    }

    public function test_moderator_change_locale_to_ru(): void
    {
        App::setLocale('en');
        $enLocale = App::getLocale();
        $response = $this->get('/locale/ru');

        $this->assertNotEquals($enLocale, App::getLocale());
        $response->assertStatus(302);
    }
}
