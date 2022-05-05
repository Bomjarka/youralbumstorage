<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            return view('main', ['user' => $user]);
        }

        return view('main');
    }

    public function about()
    {
        return view('about');
    }
}
