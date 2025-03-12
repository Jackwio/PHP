<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
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

    // Laravel 預設會回傳 HTML 格式的錯誤頁面，而不是 JSON。可以強制 Laravel 在錯誤時回傳 JSON。
    public function render($request, Throwable $exception): JsonResponse
    {
        return response()->json([
            'error' => $exception->getMessage()
        ], 500);
    }
}
