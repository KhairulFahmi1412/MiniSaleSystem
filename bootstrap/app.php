<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\VerifyAuth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        //Global middleware, called on every request 
        // $middleware->add(CheckAge::class); // Register the middlewareglobally

        //Group middleware, aka trigger multiple middlewares at once 
        //    $middleware->addMiddlewareGroup('web', [
        //     CheckAge::class,
        //     Authenticate::class,
        // ]);

        //Route-specific middleware (DOESNT EXIST IN laravel 11 anymore)
        // $middleware->addRouteMiddleware('check.age', CheckAge::class); // Register the route-specific middleware
        //NOte: the route-specific middleware means it is a non-global. 
            //It can be used on multiple routes even by 1 declaration
        // $middleware->addRouteMiddleware('auth', VerifyAuth::class);
        
        //If we want add sanctum, we need import middleware here 

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
