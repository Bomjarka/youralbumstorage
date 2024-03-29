<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleHelper;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     *
     * Возвращает страницу пользователей в админке
     *
     * @return Application|Factory|View
     */
    public function users()
    {
        $allUsers = User::orderBy('id')->get();

        return view('admin.users', ['users' => $allUsers]);
    }

    /**
     *
     * Возвращает страницу конкретного пользователя в адмнике
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function user(User $user)
    {
        return view('admin.user', ['user' => $user]);
    }

    /**
     *
     * Редактировать данные пользователя
     *
     * @param Request $request
     * @param UserService $userService
     * @return JsonResponse
     */
    public function editUser(Request $request, UserService $userService): JsonResponse
    {
        $user = User::find($request->get('userId'));

        $request->validate([
            'login' => ['string', 'max:255'],
            'first_name' => ['string', 'max:255'],
            'second_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone' => ['string', 'min:11', 'max:11'],
            'gender' => ['required', 'string'],
            'birthdate' => ['date'],
        ]);

        if (is_null($request->get('secondName'))) {
            $request->merge(['secondName' => '']);
        }
        $userData = [];
        foreach ($request->all() as $key => $value) {
            if ($key == '_token') {
                continue;
            }

            $userData[$key] = $value;
        }

        $userService->editData($userData, $user);

        return response()->json([
            'msg' => 'User data updated!',
        ]);
    }

    /**
     *
     * Блокировка пользователя из админки
     *
     * @param User $user
     * @param UserService $userService
     * @return JsonResponse
     */
    public function blockUser(User $user, UserService $userService): JsonResponse
    {
        $userService->blockUser($user);
        Log::info('User blocked', ['user' => $user]);

        return response()->json([
            'msg' => 'User blocked!',
        ]);
    }

    /**
     *
     * Разблокировать пользователя из админки
     *
     * @param User $user
     * @param UserService $userService
     * @return JsonResponse
     */
    public function unblockUser(User $user, UserService $userService): JsonResponse
    {
        $userService->unblockUser($user);
        Log::info('User unblocked', ['user' => $user]);

        return response()->json([
            'msg' => 'User unblocked!',
        ]);
    }

    /**
     *
     * Возвращает данные для диаграмм в админке
     *
     * @return Application|Factory|View
     */
    public function dashboard()
    {
        //По дефолту строим диаграммы за последние 7 дней
        $startDate = Carbon::now()->startOfDay()->subDays(7);
        $endDate = Carbon::now()->startOfDay();
        $period = CarbonPeriod::create($startDate, $endDate);
        $registeredCount = [];
        $photosUploadedCount = [];

        foreach ($period as $date) {
            $registeredCount[$date->toDateString()] = User::where('login', '!=', Role::ROLE_ADMIN)->where(DB::raw("created_at::date"), '=', $date)->count();
            $photosUploadedCount[$date->toDateString()] = Photo::where(DB::raw("created_at::date"), '=', $date)->count();
        }

        return view('admin.dashboard', ['usersRegistered' => $registeredCount, 'photosUploadedCount' => $photosUploadedCount]);
    }


    /**
     *
     * Возвращает определённый диапазон дат для выбранного периода на странце графиков
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function dashboardPeriod(Request $request): JsonResponse
    {
        $term = explode('_', $request->get('period'))[0];
        $period = explode('_', $request->get('period'))[1];
        $registeredCount = [];
        $photosUploadedCount = [];
        switch ($period) {
            case 'day':
                $startDate = Carbon::now()->startOfDay()->subDays($term - 1);
                $endDate = Carbon::now()->startOfDay();
                $period = CarbonPeriod::create($startDate, $endDate);
                foreach ($period as $date) {
                    $registeredCount[$date->toDateString()] = User::where(DB::raw("created_at::date"), '=', $date)->count();
                    $photosUploadedCount[$date->toDateString()] = Photo::where(DB::raw("created_at::date"), '=', $date)->count();
                }
                break;
            case 'month':
                $startDate = Carbon::now()->startOfDay()->subMonths($term - 1);
                $endDate = Carbon::now()->startOfDay();
                $period = CarbonPeriod::create($startDate, $endDate);
                foreach ($period as $date) {
                    $registeredCount[$date->format('F') . ' ' . $date->format('y')] = User::where(DB::raw("extract(month from created_at)"), '=', $date->format('m'))->count();
                    $photosUploadedCount[$date->format('F') . ' ' . $date->format('y')] = Photo::where(DB::raw("extract(month from created_at)"), '=', $date->format('m'))->count();
                }
                break;
        }

        return response()->json([
            'usersRegistered' => $registeredCount,
            'photosUploadedCount' => $photosUploadedCount,
        ]);

    }

    /**
     *
     * Возвращает страницу ролей
     *
     * @return Application|Factory|View
     */
    public function roles(RoleService $roleService)
    {
        $roles = $roleService->getAllRoles()->sortBy('id');

        return view('admin.roles', ['roles' => $roles]);
    }

    /**
     *
     * Отредактировать данные роли
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function editRole(Request $request): RedirectResponse
    {
        $request->validate([
            'newRoleDescription' => ['nullable', 'string', 'max:255'],
        ]);

        $roleId = $request->input('roleId');
        $role = Role::find($roleId);
        $newRoleDescription = $request->input('newRoleDescription');

        if (!$role || $newRoleDescription == $role->description) {

            return back()->with('status', 'nothing-updated');
        }

        if ($newRoleDescription) {
            $role->description = $newRoleDescription;
        }

        Log::info('Role updated', ['role' => $role, 'New Description' => $newRoleDescription]);
        $role->save();

        return back()->with('status', 'role-updated');
    }

    /**
     * Назначить роль пользователю
     *
     * @param Request $request
     * @param User $user
     * @param RoleService $roleService
     * @return RedirectResponse
     */
    public function addUserRole(Request $request, User $user, RoleService $roleService): RedirectResponse
    {
        $role = Role::find($request->get('roleId'));

        if (RoleHelper::has_role($role->name, $user->id)) {

            return back()->with('status', 'role-already-assigned');
        }

        if ($roleService->addRoleUser($role->name, $user->id)) {

            Log::info('Add user new role', ['user' => $user, 'role' => $role]);

            return back()->with('status', 'role-assigned');
        }

        Log::warning('Role wasnt assigned to user', ['user' => $user, 'role' => $role]);

        return back()->with('status', 'role-assign-error');
    }

    /**
     *
     * Снять с пользователя роль
     *
     * @param Request $request
     * @param User $user
     * @param RoleService $roleService
     * @return RedirectResponse
     */
    public function removeUserRole(Request $request, User $user, RoleService $roleService): RedirectResponse
    {
        $role = Role::find($request->get('roleId'));
        if ($roleService->removeRoleUser($role->name, $user->id)) {
            Log::info('Role removed from user', ['user' => $user, 'role' => $role]);

            return back()->with('status', 'role-disabled');
        }

        return back()->with('status', 'role-assign-error');
    }

    /**
     * Добавить привилегию пользователю
     *
     * @param Request $request
     * @param User $user
     * @param RoleService $roleService
     * @return RedirectResponse
     */
    public function addUserPermission(Request $request, User $user, RoleService $roleService): RedirectResponse
    {
        $permission = Permission::find($request->get('permissionId'));

        if (RoleHelper::has_permission($permission->name, $user->id)) {

            return back()->with('status', 'permission-already-assigned');
        }

        if ($roleService->addPermissionUser($permission->name, $user->id)) {

            Log::info('Add user new permission', ['user' => $user, 'permission' => $permission]);

            return back()->with('status', 'permission-assigned');
        }

        Log::warning('Role wasnt assigned to user', ['user' => $user, 'permission' => $permission]);

        return back()->with('status', 'permission-assign-error');
    }

    /**
     * Снять привилегию с пользователя
     *
     * @param Request $request
     * @param User $user
     * @param RoleService $roleService
     * @return RedirectResponse
     */
    public function removeUserPermission(Request $request, User $user, RoleService $roleService): RedirectResponse
    {
        $permission = Permission::find($request->get('permissionId'));
        if ($roleService->removePermissionUser($permission->name, $user->id)) {
            Log::info('Permission removed from user', ['user' => $user, 'permission' => $permission]);

            return back()->with('status', 'permission-disabled');
        }

        return back()->with('status', 'permission-assign-error');
    }

    /**
     * @param User $user
     * @param UserService $userService
     * @return JsonResponse
     */
    public function deleteUser(User $user, UserService $userService)
    {
        if (RoleHelper::has_role(Role::ROLE_ADMIN, Auth::user()->id)) {
            $userService->deleteUser($user);

            return response()->json([
                'status' => trans('approving-blade.title'),
                'redirect' => route('adminUsers'),
            ]);
        }

        return response()->json([
            'status' => 'failed',
        ]);
    }

    /**
     * @param RoleService $roleService
     * @return Application|Factory|View
     */
    public function permissions(RoleService $roleService)
    {
        $permissions = $roleService->getAllPermissions()->sortBy('id');

        return view('admin.permissions', ['permissions' => $permissions]);
    }

    public function editPermission(Request $request)
    {
        $request->validate([
            'newPermissionDescription' => ['nullable', 'string', 'max:255'],
        ]);

        $permissionId = $request->input('permissionId');
        $permission = Permission::find($permissionId);
        $newPermissionDescription = $request->input('newPermissionDescription');

        if (!$permission || $newPermissionDescription == $permission->description) {

            return back()->with('status', 'nothing-updated');
        }

        if ($newPermissionDescription) {
            $permission->description = $newPermissionDescription;
        }

        Log::info('Permission updated', ['permission' => $permission, 'New Description' => $newPermissionDescription]);
        $permission->save();

        return back()->with('status', 'permission-updated');
    }
}
