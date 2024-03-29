<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserPermission;
use App\Models\UserRole;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Facades\DB;


class RoleService
{
    /**
     * Все привилегии установленные в приложении
     * @var EloquentCollection
     */
    protected $allPermissions;

    /**
     * Все роли установленные в приложении
     * @var EloquentCollection
     */
    protected $allRoles;

    /**
     * Список привилегий пользователей. Ключ - id пользователя.
     * @var EloquentCollection[]
     */
    protected $userPermissions;

    /**
     * Список привилегий пользователей. Ключ - id пользователя.
     * @var EloquentCollection[]
     */
    protected $rolePermissions;

    /**
     * Список ролей пользователей. Ключ - id пользователя
     * @var EloquentCollection[]
     */
    protected $userRoles;

    /**
     * Проверка привилегии на существование
     * @param string $permission - наименование привилегии
     * @return bool
     */
    public function permissionExists(string $permission): bool
    {
        return $this->getAllPermissions()->contains('name', $permission);
    }

    /**
     * Получение всех привилегий установленных в приложении
     * @return EloquentCollection
     */
    public function getAllPermissions(): EloquentCollection
    {
        return $this->allPermissions = $this->allPermissions ?? Permission::all();
    }

    /**
     * Проверка роли на существование
     * @param string $role - наименование роли
     * @return bool
     */
    public function roleExists(string $role): bool
    {
        return $this->getAllRoles()->contains('name', $role);
    }

    /**
     * Получение всех ролей установленных в приложении
     * @return EloquentCollection
     */
    public function getAllRoles(): EloquentCollection
    {
        return $this->allRoles = $this->allRoles ?? Role::all();
    }

    /**
     *
     * Создание новой роли приложения
     *
     * @param string $name
     * @param string|null $description
     * @return Role
     */
    public function createRole(string $name, string $description = null): Role
    {
        return Role::create([
            'name' => $name,
            'description' => $description,
        ]);
    }

    /**
     *
     * Создание новой привилегии приложения
     *
     * @param string $name
     * @param string|null $description
     * @return Permission
     */
    public function createPermission(string $name, string $description = null): Permission
    {
        return Permission::create([
            'name' => $name,
            'description' => $description,
        ]);
    }

    /**
     * Добавление новой привилегии пользователю
     * @param string $permission - наиенование привилегии
     * @param int $userId - id пользователя (user)
     * @return bool
     */
    public function addPermissionUser(string $permission, int $userId): bool
    {
        $permissionModel = $this->getAllPermissions()->keyBy('name')->get($permission);
        if (!$permissionModel || $this->hasPermission($permission, $userId)) {
            return false;
        }
        $this->userPermissions[$userId]->add($permissionModel);
        return (bool)UserPermission::create(['user_id' => $userId, 'permission_id' => $permissionModel->id]);
    }

    /**
     * Проверка наличия привилегии у пользователя
     * @param string $permission
     * @param int $userId
     * @return bool
     */
    public function hasPermission(string $permission, int $userId): bool
    {
        return $this->getUserPermissions($userId)->contains('name', $permission);
    }

    /**
     * Получение всех имеющихся у пользователя привилегий
     * @param int $userId - id пользователя (user)
     * @return EloquentCollection
     */
    public function getUserPermissions(int $userId): EloquentCollection
    {
        if (!isset($this->userPermissions[$userId])) {
            $ids = UserPermission::whereUserId($userId)->pluck('permission_id')->toArray();
            $this->userPermissions[$userId] = $this->getAllPermissions()->whereIn('id', $ids);
        }

        return $this->userPermissions[$userId];
    }

    /**
     * Получение всех имеющихся у пользователя привилегий
     * @param int $userId - id пользователя (user)
     * @return EloquentCollection
     */
    public function getRolePermissions(int $roleId): EloquentCollection
    {
        if (!isset($this->rolePermissions[$roleId])) {
            $ids = RolePermission::whereRoleId($roleId)->pluck('permission_id')->toArray();
            $this->rolePermissions[$roleId] = $this->getAllPermissions()->whereIn('id', $ids);
        }

        return $this->rolePermissions[$roleId];
    }

    /**
     * Добавляет роль пользователю
     * @param string $roleName
     * @param int $userId
     * @return bool
     */
    public function addRoleUser(string $roleName, int $userId): bool
    {
        $roleAddedToUser = DB::transaction(
            function () use ($roleName, $userId) {
                $roleModel = $this->getAllRoles()->keyBy('name')->get($roleName);
                if (!$roleModel || $this->hasRole($roleName, $userId)) {
                    return false;
                }
                $this->userRoles[$userId]->add($roleModel);
                //после добавления роли добавим и привилегии
                $rolePermissions = $this->getRolePermissions($roleModel->id);

                foreach ($rolePermissions as $rolePermission) {
                    $this->addPermissionUser($rolePermission->name, $userId);
                }

                return (bool)UserRole::create(['user_id' => $userId, 'role_id' => $roleModel->id]);
            });

        return $roleAddedToUser;
    }

    /**
     * Проверка на существование роли у пользователя
     * @param string $role
     * @param int $userId
     * @return bool
     */
    public function hasRole(string $role, int $userId): bool
    {
        return $this->getUserRoles($userId)->contains('name', $role);
    }

    /**
     * Возвращает все ролеи имеющихся у пользователя
     * @param int $userId
     * @return EloquentCollection
     */
    public function getUserRoles(int $userId): EloquentCollection
    {
        if (!isset($this->userRoles[$userId])) {
            $ids = UserRole::whereUserId($userId)->pluck('role_id')->toArray();
            $this->userRoles[$userId] = $this->getAllRoles()->whereIn('id', $ids);
        }
        return $this->userRoles[$userId];
    }

    /**
     * Удаляет привилегию у пользователя
     * @param string $permission - наименование привилегии
     * @param int $userId - id пользователя (user)
     * @return bool
     */
    public function removePermissionUser(string $permission, int $userId): bool
    {
        $model = $this->getUserPermissions($userId)->keyBy('name')->get($permission);
        if (!$model) {
            return false;
        }
        $this->userPermissions[$userId] = $this->userPermissions[$userId]->filter(function ($v) use ($model) {
            return $v->id != $model->id;
        });
        return (bool)UserPermission::wherePermissionId($model->id)->whereUserId($userId)->delete();
    }

    /**
     * Удаляет роль у пользователя
     * @param string $roleName - наименование роли
     * @param int $userId - id пользователя (user)
     * @return bool
     */
    public function removeRoleUser(string $roleName, int $userId): bool
    {
        $roleRemovedFromUser = DB::transaction(
            function () use ($roleName, $userId) {
                $model = $this->getUserRoles($userId)->keyBy('name')->get($roleName);
                if (!$model) {
                    return false;
                }
                $this->userRoles[$userId] = $this->userRoles[$userId]->filter(function ($v) use ($model) {
                    return $v->id != $model->id;
                });
                //после удаления роли удалим и привилегии
                $rolePermissions = $this->getRolePermissions($model->id);

                foreach ($rolePermissions as $rolePermission) {
                    $this->removePermissionUser($rolePermission->name, $userId);
                }

                return (bool)UserRole::whereRoleId($model->id)->whereUserId($userId)->delete();
            });

        return $roleRemovedFromUser;
    }

    /**
     * Возвращает всех пользователей администраторов
     *
     * @return mixed
     */
    public function getAdministrators()
    {
        $adminRole = Role::whereName(Role::ROLE_ADMIN)->first();

        return User::whereIn('id', UserRole::whereRoleId($adminRole->id)->pluck('user_id'))->get();
    }
}
