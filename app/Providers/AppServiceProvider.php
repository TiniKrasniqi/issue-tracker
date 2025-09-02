<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Logic for logged-in user
            if (Auth::check()) {
                $view->with('loggedInUser', Auth::user());
            }
    
            $settings = \Cache::rememberForever('app_settings', function () {
                return config('websettings', []);
            });
        
            // Share the settings with views
            View::share('settings', $settings);
        });
    }
}
