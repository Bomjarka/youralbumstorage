<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
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
        if ($roleService->addRoleUser('admin', $user->id)) {
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
        if ($roleService->removeRoleUser('admin', $user->id)) {
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

        $dates = [];
        foreach ($period as $date) {
            $dates[] = $date->toDateString();
        }

        $select =  DB::select("SELECT created_at::date, count(id) FROM users GROUP BY created_at::date");


        return view('admin.dashboard', ['dates' => $dates, 'select' => $select]);
    }

}
