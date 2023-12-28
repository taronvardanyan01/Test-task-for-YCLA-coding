<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Throwable;

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

    public function render($request, Throwable $e): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($e instanceof AuthenticationException || $e instanceof RouteNotFoundException) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        if ($e instanceof ValidationException) {
            return response()->json(['error' => $e->errors()], 422);
        }

        if ($e instanceof NotFoundResourceException) {
            return response()->json(['error' => $e->getMessage()], 404);
        }

        if ($e instanceof \Exception) {
            return response()->json(['error' => $e->getMessage()], 422);
        }

        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
