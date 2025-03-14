<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Menambahkan middleware grup untuk API
        $middleware->group('api', [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class, // Throttle API request
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // Menambahkan alias middleware
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'scope' => \App\Http\Middleware\CheckScope::class,
            'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Pastikan ada alias throttle
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        
    })->create();
