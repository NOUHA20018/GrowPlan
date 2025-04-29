<?php

use App\Http\Middleware\ApprenantMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->prefix('webhooks') // URL: /webhooks/...
                ->name('webhooks.') // smiya dyal les routes: webhooks.nom_route
                ->group(base_path('routes/webhooks.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('apprenant', [
            \App\Http\Middleware\ApprenantMiddleware::class,
        ]);
        // $middleware->alias({
        //     'apprenant' => ApprenantMiddleware::class,
        // });
        $middleware->group('formateur', [
            \App\Http\Middleware\FormateurMiddleware::class,
        ]);
    
        $middleware->group('admin', [
            \App\Http\Middleware\AdminMiddleware::class,
        ]);
        })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
