<?php

namespace App\Http\Controllers;

use App\Mail\ErrorHandled;
use App\Mail\FeedbackEmail;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use Throwable;

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


    public function feedback(Request $request)
    {
        $toEmail = config('mail.mailers.smtp.username');
        $message = $request->get('message');
        $fromName = $request->get('name');
        $fromEmail = $request->get('email');


        if ($user = User::find($request->get('userId'))) {
            Mail::to($toEmail)->send(new FeedbackEmail($user->email, $message, $fromName, $user));

            return back();
        }

        Mail::to($toEmail)->send(new FeedbackEmail($fromEmail, $message, $fromName));

        return back();
    }
}
