<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Возвращает главную страницу
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if ($user = Auth::user()) {
            return view('main', ['user' => $user]);
        }

        return view('main');
    }

    /**
     *
     * Возвращает страницу О Приложении
     *
     * @return Application|Factory|View
     */
    public function about()
    {
        return view('about');
    }
}
