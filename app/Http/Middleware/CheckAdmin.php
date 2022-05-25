<?php

namespace App\Http\Middleware;

use App\Helpers\RoleHelper;
use App\Models\Role;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Проверяем является ли пользователь администратором или модератором
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (RoleHelper::has_role_any([Role::ROLE_ADMIN, Role::ROLE_MODERATOR], Auth::user()->id)) {

            return $next($request);
        }

        return redirect('login');
    }
}
