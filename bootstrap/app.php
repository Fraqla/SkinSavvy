<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: base_path('routes/api.php'),
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // config(['cors' => require config_path('cors.php')]);
        $middleware->validateCsrfTokens(except: [
            // Add routes that don't need CSRF here
        ]);
        
        $middleware->trustProxies(at: [
            '127.0.0.1', // Add your trusted proxies
        ]);
        
        // CORS configuration
        $middleware->appendToGroup('api', [
            \Illuminate\Http\Middleware\HandleCors::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
