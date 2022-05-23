<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Rules\PasswordRules;
use App\Services\Registration\RegistrationService;
use App\Services\Registration\UserData;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request
     * @param RegistrationService $regisTrationService
     * @return RedirectResponse
     *
     */
    public function store(Request $request, RegistrationService $regisTrationService): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string', 'max:255', 'unique:users'],
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
            'gender' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
            'password' => ['required', 'confirmed', PasswordRules::defaults()],
        ]);

        $user = $regisTrationService->registerUser(UserData::prepareData($request));
        Log::info('New user registered', ['user: ' => $user]);
        event(new Registered($user));
        Auth::login($user);

        return redirect('/')->with('status', 'verification-link-sent');
    }
}
