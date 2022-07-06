<?php

namespace App\Exceptions;

use App\Mail\ErrorHandled;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Request;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
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
            $url = Request::url() . '/' . Request::method();
            $this->sendEmail($exception, $url);

            try {
                $logger = $this->container->make(LoggerInterface::class);
            } catch (Exception $ex) {
                throw $exception;
            }

            $logger->error(
                $exception->getMessage(),
                array_merge(
                    $this->exceptionContext($exception),
                    $this->context(),
                    ['url' => $url]
                )
            );
        }
    }

    /**
     * Отправляем письмо с ошибкой на почту
     *
     * @param Throwable $exception
     * @param string $url
     * @return void
     */
    public function sendEmail(Throwable $exception, string $url): void
    {
        try {
            Mail::to('admin@youralbumstorage.ru')->send(new ErrorHandled($exception, $url));
        } catch (Throwable $exception) {
            Log::error($exception);
        }
    }
}
