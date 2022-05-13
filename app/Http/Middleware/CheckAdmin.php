<?php

namespace App\Http\Middleware;

use App\Helpers\RoleHelper;
use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Проверяем является ли пользователь администратором
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (RoleHelper::has_role(Role::ROLE_ADMIN, Auth::user()->id)) {
            return $next($request);
        }

        return redirect('login');
    }
}
