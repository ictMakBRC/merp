<?php

namespace App\Exceptions;

use Throwable;
use Exception;
use Illuminate\Session\TokenMismatchException; // Import the TokenMismatchException class
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
class Handler extends ExceptionHandler

{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, $exception)
    {
        // Handle TokenMismatchException
        if ($exception instanceof TokenMismatchException) {
            // Custom logic to handle CSRF token mismatch
            return redirect()->back()->withInput()->with('error', 'CSRF token has expired. Please try again.'); // Example: Redirect back with an error message
        }

        return parent::render($request, $exception);
    }
}
