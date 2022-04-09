<?php

namespace App\Helpers;

use App\Services\RoleService;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;


class RoleHelper
{
    /**
     * Проверка на существование привилегии у пользователя
     * @param string $permission - Имя привилегии для проверики
     * @param int $userId - id пользователя (user)
     * @return bool | true - привилегия есть, false - привилегии нет
     * @throws InvalidArgumentException - привилегия не найдена
     */
    public static function has_permission(string $permission, int $userId): bool
    {
        if (!self::rs()->permissionExists($permission)) {
            throw new InvalidArgumentException("The permission $permission not found");
        }
        return self::rs()->hasPermission($permission, $userId);
    }

    /**
     * Проверка на существование одной из переданных привилегий у пользователя
     * @param array $permissions - массив имен привилегий для проверки
     * @param int $userId - id пользователя для проверки (user)
     * @return bool | true - если хотя бы одна из привилегий, false - если нет ни одной из привилегий
     * @throws InvalidArgumentException - если хотбы одна привилегия не найденна
     */
    public static function has_permission_any(array $permissions, int $userId): bool
    {
        foreach ($permissions as $permission) {
            if (self::has_permission($permission, $userId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Проверка на существование всех переданных привилегий у пользователя
     * @param array $permissions - массив имен переменных для проверки
     * @param int $userId - id пользователя для проверки (user)
     * @return bool | true - если есть все переданные привилегии, false - если нет хотябы одной из указанных привилегий
     * @throws InvalidArgumentException - если хотябы одна из привилегий не найденна
     */
    public static function has_permission_all(array $permissions, int $userId): bool
    {
        foreach ($permissions as $permission) {
            if (!self::has_permission($permission, $userId)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Проверка на существование переданной роли у пользователя
     * @param string $role - наименование роли
     * @param int $userId - id пользователя (user)
     * @return bool | true - если у пользователя существует переданная роль, false - если у пользователя переданной роли нет
     * @throws InvalidArgumentException - если переданная роль не найденна
     */
    public static function has_role(string $role, int $userId): bool
    {
        if (!self::rs()->roleExists($role)) {
            throw new InvalidArgumentException("The role $role not found");
        }
        return self::rs()->hasRole($role, $userId);
    }

    /**
     * Проверка на существование хотябы одной из переданных ролей у пользователя
     * @param array $roles - массив имен ролей для проверки у пользователя.
     * @param int $userId - id пользователя для проверки (user)
     * @return bool | true - если у пользователя есть хотябы одна из переданных ролей, false - если у пользователя нет ни одной из переданных ролей
     * @throws InvalidArgumentException - если хотябы одна из переданных ролей не найденна.
     */
    public static function has_role_any(array $roles, int $userId): bool
    {
        foreach ($roles as $role) {
            if (self::has_role($role, $userId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Получение списка всех ролей, установленных в приложени
     * @return EloquentCollection of Role
     */
    public static function get_all_roles(): EloquentCollection
    {
        return self::rs()->getAllRoles();
    }

    /**
     * Получение списка ролей для переданного пользователя
     * @param int $userId - id пользователя (user)
     * @return EloquentCollection of Roles
     */
    public static function get_user_roles(int $userId): EloquentCollection
    {
        return self::rs()->getUserRoles($userId);
    }

    /**
     * Получение списка ролей которых нет у пользователя
     * @param int $userId - id пользователя (user)
     * @return EloquentCollection of Roles
     */
    public static function get_user_missing_roles(int $userId): EloquentCollection
    {
        $ids = self::get_user_roles($userId)->pluck('id')->toArray();
        return self::get_all_roles()->filter(function ($v) use ($ids) {
            return !in_array($v->id, $ids);
        });
    }

    /**
     * @return RoleService
     */
    public static function rs(): RoleService
    {
        return app(RoleService::class);
    }
}

