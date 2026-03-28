<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // 1. Apply the PreventBackHistory to all web routes
        $middleware->web(append: [
            \App\Http\Middleware\PreventBackHistory::class,
        ]);

        // 2. Keep your existing aliases
        $middleware->alias([
            // This tells Laravel to use YOUR new logic for the 'guest' middleware
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
