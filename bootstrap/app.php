<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if (request()->expectsJson()) {
            $exceptions->render(function (Exception $e) {
                $msg = $e->getMessage().' '.$e->getFile().' '.$e->getLine();
                $state = -2;
                $code = 500;

                switch (true) {
                    case $e instanceof ValidationException:
                        $msg = $e->getMessage();
                        $code = 400;
                        break;
                    case $e instanceof AuthenticationException:
                        $msg = 'Not authenticated (login required)';
                        $state = $code = 401;
                        break;
                    case $e instanceof ModelNotFoundException:
                    case $e instanceof NotFoundHttpException:
                        $msg = '404(NOT FOUND)';
                        $state = $code = 404;
                        break;
                    case $e instanceof MethodNotAllowedHttpException:
                        $msg = '405(Method Not Allowed)';
                        $state = $code = 405;
                        break;
                    case $e instanceof UnauthorizedHttpException:
                        $msg = 'Verification failed';
                        $state = $code = 422;
                        break;
                    case $e instanceof HttpException:
                        $msg = $e->getMessage();
                        switch ($e->getStatusCode()) {
                            case 401:
                                $state = $code = 401;
                                break;
                            default:
                                $code = $e->getStatusCode();
                                break;
                        }
                }

                return responseHelper(false, $msg, $state, $code);
            });
        }
    })->create();
