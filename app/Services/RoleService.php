<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;
use App\Models\UserPermission;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;


use App\Models\UserRole;

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
     * @return void
     */
    public function createRole(string $name, string $description = null): void
    {
        Role::create([
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
     * Добавляет роль пользователю
     * @param string $role
     * @param int $userId
     * @return bool
     */
    public function addRoleUser(string $role, int $userId): bool
    {
        $roleModel = $this->getAllRoles()->keyBy('name')->get($role);
        if (!$roleModel || $this->hasRole($role, $userId)) {
            return false;
        }
        $this->userRoles[$userId]->add($roleModel);
        return (bool)UserRole::create(['user_id' => $userId, 'role_id' => $roleModel->id]);
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
     * @param string $role - наименование роли
     * @param int $userId - id пользователя (user)
     * @return bool
     */
    public function removeRoleUser(string $role, int $userId): bool
    {
        $model = $this->getUserRoles($userId)->keyBy('name')->get($role);
        if (!$model) {
            return false;
        }
        $this->userRoles[$userId] = $this->userRoles[$userId]->filter(function ($v) use ($model) {
            return $v->id != $model->id;
        });
        return (bool)UserRole::whereRoleId($model->id)->whereUserId($userId)->delete();
    }
}
