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
        } else {
            return view('main');
        }
    }

    public function albums()
    {
        if ($user = Auth::user()) {
            $albums = Album::whereUserId($user->id)->orderBy('id')->simplePaginate(5);
            return view('user.albums', ['albums' => $albums]);
        } else {
            return view('guest.albums');
        }
    }

    public function photos()
    {
        if ($user = Auth::user()) {
            $photos = Photo::whereUserId($user->id)->orderBy('id')->get();
            return view('user.photos', ['photos' => $photos]);
        } else {
            return view('guest.photos');
        }
    }

    public function about()
    {
        return view('about');
    }
}
