<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_can_view_admin()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);

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

    public function test_admin_can_view_users()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/users');
        $response->assertViewHas('users', $response->getOriginalContent()->getData()['users']);
        $response->assertStatus(200);
    }

    public function test_admin_can_view_user()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/users/' . $user->id);
        $response->assertViewHas('user', $user);
        $response->assertStatus(200);
    }

    public function test_admin_can_view_roles()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/roles');
        $response->assertViewHas('roles', $response->getOriginalContent()->getData()['roles']);
        $response->assertStatus(200);
    }

    public function test_admin_can_view_permissions()
    {
        $user = User::factory()->create(['is_blocked' => false]);
        $roleService = new RoleService();
        $roleService->addRoleUser(Role::ROLE_ADMIN, $user->id);

        $this->actingAs($user);

        $response = $this->get('/admin/permissions');
        $response->assertViewHas('permissions', $response->getOriginalContent()->getData()['permissions']);
        $response->assertStatus(200);
    }

    public function test_admin_change_locale_to_en()
    {
        $ruLocale = App::getLocale();
        $response = $this->get('/locale/en');

        $this->assertNotEquals($ruLocale, App::getLocale());
        $response->assertStatus(302);
    }

    public function test_amin_change_locale_to_ru()
    {
        App::setLocale('en');
        $enLocale = App::getLocale();
        $response = $this->get('/locale/ru');

        $this->assertNotEquals($enLocale, App::getLocale());
        $response->assertStatus(302);
    }
}
