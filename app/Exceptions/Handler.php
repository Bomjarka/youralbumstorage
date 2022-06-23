<?php

namespace App\Exceptions;

use App\Mail\ErrorHandled;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        NotFoundHttpException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Exception
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        if (!$exception instanceof NotFoundHttpException) {
            $this->sendEmail($exception);

            parent::report($exception);
        }
    }

    /**
     * Отправляем письмо с ошибкой на почту
     *
     * @param Throwable $exception
     * @return void
     */
    public function sendEmail(Throwable $exception): void
    {
        try {
            Mail::to('admin@youralbumstorage.ru')->send(new ErrorHandled($exception));
        } catch (Throwable $exception) {
            Log::error($exception);
        }
    }
}
