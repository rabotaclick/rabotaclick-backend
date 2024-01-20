<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if($e instanceof ThrottleRequestsException) {
            return response()->json([
                'seconds' => $e->getHeaders()['Retry-After'],
                'message' => 'Превышено допустимое количество попыток. Попробуйте повторить запрос позднее'
            ], 429);
        }
        if(env('APP_ENV') == 'production') {
            return response()->json([
                'error' => $e->getMessage()
            ], $e->getCode() ?? 200);
        } else {
            return parent::render($request, $e);
        }
    }
}
