<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $this->redirectToLowerUrl($request);

        if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return redirect()->route('home');
        }

        return parent::render($request, $exception);
    }

    private function redirectToLowerUrl($request)
    {
        // Настроить 301 редирект со всех страниц с URL в верхнем регистре на соответствующие им страницы с URL в нижнем регистре.
        $uri      = strtok($_SERVER["REQUEST_URI"], '?');
        $lowerURI = mb_strtolower($uri, 'UTF-8');

        if (($uri != $lowerURI) && strpos($uri, '/admin/') === false) {
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: http://" . $_SERVER['HTTP_HOST'] . $lowerURI . '?' . $_SERVER['QUERY_STRING']);
            exit;
        }

        return true;
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        $guard = array_get($exception->guards(), 0);

        switch ($guard) {
            case 'admin':
                $login = 'admin.login';
                break;
            
            default:
                $login = 'login';
                break;
        }

        return redirect()->guest(route($login, $_SERVER['QUERY_STRING']));
    }
}
