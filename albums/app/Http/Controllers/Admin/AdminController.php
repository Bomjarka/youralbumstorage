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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function users()
    {
        $allUsers = User::orderBy('id')->get();
        return view('admin.users', ['users' => $allUsers]);
    }

    public function user(User $user)
    {
        return view('admin.user', ['user' => $user]);
    }

    public function blockUser(User $user, UserService $userService)
    {
        $userService->block($user);

        return response()->json([
            'msg' => 'User blocked!',
        ]);
    }

    public function unblockUser(User $user, UserService $userService)
    {
        $userService->unblock($user);

        return response()->json([
            'msg' => 'User unblocked!',
        ]);
    }

    public function makeAdmin(User $user, RoleService $roleService)
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

    public function disableAdmin(User $user, RoleService $roleService)
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

    public function dashboard()
    {
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


    public function dashboardPeriod(Request $request)
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

    public function roles()
    {
        $roles = Role::all()->sortBy('id');

        return view('admin.roles', ['roles' => $roles]);
    }

    public function addRole(Request $request, RoleService $roleService)
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

    public function editRole(Request $request)
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

    public function addUserRole(Request $request, User $user, RoleService $roleService)
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

    public function removeUserRole(Request $request, User $user, RoleService $roleService)
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
