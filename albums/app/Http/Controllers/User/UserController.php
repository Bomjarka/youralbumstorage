<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.albums');
    }

    public function profile()
    {
        return view('user.profile', ['user' => Auth::user()]);
    }

    public function edit(Request $request, UserService $userService)
    {

        $user = User::find($request->get('userId'));

        $request->validate([
            'login' => ['string', 'max:255'],
            'first_name' => ['string', 'max:255'],
            'second_name' => ['string', 'max:255'],
            'last_name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'phone' => ['string', 'min:11', 'max:11'],
            'gender' => ['required', 'string'],
            'birthdate' => ['date'],
        ]);
        $userData = [];
        foreach ($request->all() as $key => $value) {
            if ($key == '_token') {
                continue;
            }
            $userData[$key] = $value;
        }

        $user->login = $userData['login'];
        $user->first_name = $userData['firstName'];
        $user->second_name = $userData['secondName'];
        $user->last_name = $userData['lastName'];
        $user->sex = $userData['gender'];
        $user->phone = $userData['phone'];
        $user->email = $userData['email'];
        $user->birthdate = $userData['birthdate'];

        $user->save();

        return response()->json([
            'msg' => 'User data updated!',
        ]);
    }


}
