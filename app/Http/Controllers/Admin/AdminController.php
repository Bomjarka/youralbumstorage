<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleHelper;
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\DB;

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
     * Блокировка пользователя из админки
     *
     * @param User $user
     * @param UserService $userService
     * @return JsonResponse
     */
    public function blockUser(User $user, UserService $userService): JsonResponse
    {
        $userService->block($user);

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
        $userService->unblock($user);

        return response()->json([
            'msg' => 'User unblocked!',
        ]);
    }

    /**
     *
     * Сделать пользователя администратором в админке
     *
     * @param User $user
     * @param RoleService $roleService
     * @return JsonResponse
     */
    public function makeAdmin(User $user, RoleService $roleService): JsonResponse
    {
        if ($roleService->addRoleUser(Role::ROLE_ADMIN, $user->id)) {
            return response()->json([
                'msg' => 'User is admin now!',
            ]);
        }

        return response()->json([
            'msg' => 'Something wrong!',
        ]);
    }

    /**
     *
     * Забрать роль администратора у пользователя
     *
     * @param User $user
     * @param RoleService $roleService
     * @return JsonResponse
     */
    public function disableAdmin(User $user, RoleService $roleService): JsonResponse
    {
        if ($roleService->removeRoleUser(Role::ROLE_ADMIN, $user->id)) {
            return response()->json([
                'msg' => 'Admin role removed!',
            ]);
        }

        return response()->json([
            'msg' => 'Something wrong!',
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
        $roles = $roleService->getAllRoles();

        return view('admin.roles', ['roles' => $roles]);
    }

    /**
     *
     * Создать новую роль в приложении
     *
     * @param Request $request
     * @param RoleService $roleService
     * @return RedirectResponse
     */
    public function addRole(Request $request, RoleService $roleService): RedirectResponse
    {
        $request->validate([
            'role_name' => ['nullable', 'string', 'max:255'],
            'role_description' => ['nullable', 'string', 'max:255'],
        ]);

        $roleName = $request->input('role_name');
        $roleDescription = $request->input('role_description');
        $roleService->createRole($roleName, $roleDescription);

        return back()->with('status', 'role-created');
    }


    /**
     *
     * Отредактировать данные роли
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function editRole(Request $request): JsonResponse
    {
        $request->validate([
            'newRoleDescription' => ['nullable', 'string', 'max:255'],
        ]);

        $roleId = $request->input('roleId');
        $role = Role::find($roleId);

        if (!$role) {
            return response()->json([
                'msg' => 'Nothing to update!',
            ]);
        }

        $newRoleDescription = $request->input('newRoleDescription');
        if ($newRoleDescription) {
            $role->description = $newRoleDescription;
        }

        $role->save();

        return response()->json([
            'msg' => 'Role updated!',
        ]);
    }

    /**
     *
     * Назначить роль пользователю
     *
     * @param Request $request
     * @param User $user
     * @param RoleService $roleService
     * @return JsonResponse
     */
    public function addUserRole(Request $request, User $user, RoleService $roleService): JsonResponse
    {
        $role = Role::find($request->get('roleId'));
        if (!RoleHelper::has_role($role->name, $user->id) && $roleService->addRoleUser($role->name, $user->id)) {
            return response()->json([
                'msg' => 'Role added to user!',
            ]);
        }

        return response()->json([
            'msg' => 'Something wrong!',
        ]);
    }

    /**
     *
     * Снять с пользователя роль
     *
     * @param Request $request
     * @param User $user
     * @param RoleService $roleService
     * @return JsonResponse
     */
    public function removeUserRole(Request $request, User $user, RoleService $roleService): JsonResponse
    {
        $role = Role::find($request->get('roleId'));
        if ($roleService->removeRoleUser($role->name, $user->id)) {

            return response()->json([
                'msg' => 'Role deleted from user!',
            ]);
        }

        return response()->json([
            'msg' => 'Something wrong!',
        ]);

    }

}
