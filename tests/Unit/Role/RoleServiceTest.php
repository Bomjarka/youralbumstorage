<?php

namespace Tests\Unit\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RoleServiceTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @return void
     */
    public function test_create_role(): void
    {
        $roleName = 'New role';
        $roleDescription = 'New role description';

        $this->assertNull(Role::whereName($roleName)->first());

        (new RoleService())->createRole($roleName, $roleDescription);
        $this->assertNotNull(Role::whereName($roleName)->first());
    }

    /**
     * @return void
     */
    public function test_create_permission(): void
    {
        $permissionName = 'New permission';
        $permissionDescription = 'New permission description';

        $this->assertNull(Permission::whereName($permissionName)->first());

        (new RoleService())->createPermission($permissionName, $permissionDescription);
        $this->assertNotNull(Permission::whereName($permissionName)->first());
    }

    /**
     * @return void
     */
    public function test_add_role_to_user(): void
    {
        $role = Role::whereName(Role::ROLE_ADMIN)->first();
        $user = $this->createUser();

        $roleService = new RoleService();
        $rolePermissons = $roleService->getRolePermissions($role->id);

        $this->assertEmpty($roleService->getUserRoles($user->id));
        $this->assertEmpty($roleService->getUserPermissions($user->id));

        $roleService->addRoleUser($role->name, $user->id);
        $this->assertTrue($roleService->hasRole($role->name, $user->id));
        $this->assertEquals($rolePermissons, $roleService->getUserPermissions($user->id));
    }

    /**
     * @return void
     */
    public function test_delete_role_from_user(): void
    {
        $role = Role::whereName(Role::ROLE_ADMIN)->first();
        $roleService = new RoleService();
        $admin = $this->createAdmin();
        $rolePermissons = $roleService->getRolePermissions($role->id);

        $this->assertTrue($roleService->hasRole($role->name, $admin->id));
        $this->assertEquals($rolePermissons, $roleService->getUserPermissions($admin->id));

        $roleService->removeRoleUser($role->name, $admin->id);
        $this->assertFalse($roleService->hasRole($role->name, $admin->id));
        $this->assertEmpty($roleService->getUserPermissions($admin->id));
    }

    /**
     * @return Collection|Model
     */
    private function createUser()
    {
        return User::factory()->create(['is_verified' => true, 'is_blocked' => false]);
    }

    /**
     * @return Collection|Model
     */
    private function createAdmin()
    {
        $role = Role::whereName(Role::ROLE_ADMIN)->first();
        $user = $this->createUser();

        $roleService = new RoleService();
        $roleService->addRoleUser($role->name, $user->id);

        return $user;
    }
}
