<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        then:function(){
            Route::middleware('web')->group(base_path('routes/auth/auth.php'));
            Route::middleware('web')->group(base_path('routes/auth/password-reset.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/auth/verification.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/dashboard/web.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/user/web.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/role/web.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/settings/web.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/projects.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/issues.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/tags.php'));
            Route::middleware(['web', 'auth'])->group(base_path('routes/search.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
