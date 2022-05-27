<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
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
     * @param RegistrationService $registrationService
     * @return RedirectResponse
     *
     */
    public function store(RegisterUserRequest $request, RegistrationService $registrationService): RedirectResponse
    {
        if ($request->validated()) {
            $user = $registrationService->registerUser(UserData::prepareData($request));
            Log::info('New user registered', ['user: ' => $user]);
            event(new Registered($user));
            Auth::login($user);

            return redirect('/')->with('status', 'verification-link-sent');
        }

        return back()->with('status', 'registration-error');
    }
}
