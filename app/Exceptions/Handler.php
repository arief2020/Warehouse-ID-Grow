<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(function (Throwable $exception, $request) {
            if ($request->is('api/*')) {
                if ($exception instanceof AuthenticationException) {
                    return response()->json([
                    'error' => 'Not authenticated',
                    'message' => 'Token required'
                    ], 401);
                }

                if ($exception instanceof ModelNotFoundException) {
                    return response()->json([
                    'error' => 'Resource Not Found',
                    'message' => 'The requested resource could not be found.'
                    ], 404);
                }

                if ($exception instanceof ValidationException) {
                    return response()->json([
                    'error' => 'Validation Error',
                    'message' => $exception->validator->errors()
                    ], 400);
                }


                return response()->json([
            'error' => 'Server Error',
            'message' => $exception->getMessage()
        ], 500);

            }
        });
    }

}
