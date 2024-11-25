<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }


    public function render($request, Throwable $exception): Response
    {
        // Custom validation error response
        if ($exception instanceof ValidationException) {

            $fields             = collect([]);
            foreach ($exception->errors() as $Name => $Messages) {
                $fields->push([
                    'field'     => $Name,
                    'message'   => count($Messages) > 0 ? $Messages[0] : '',
                ]);
            }

            return response()->json([
                'message'       => 'The given data was invalid.',
                'data'          => [],
                'errors'        => ['invalid_fields' => $fields],
                'code'          => 422
            ], 422);
        }

        return parent::render($request, $exception);
    }
}
