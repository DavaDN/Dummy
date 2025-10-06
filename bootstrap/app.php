<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Global middleware (opsional)
        $middleware->use([
            // \App\Http\Middleware\TrustProxies::class,
            // \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        ]);

        // Middleware grup untuk web
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // Middleware grup untuk API (tanpa session)
        $middleware->group('api', [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handler exception default
        $exceptions->report(function (Throwable $e) {
            //
        });

        $exceptions->render(function (Throwable $e, $request) {
            // Format respons JSON jika error terjadi di API
            if ($request->is('api/*')) {
                return response()->json([
                    'error' => $e->getMessage(),
                ], 500);
            }
        });
    })
    ->create();
