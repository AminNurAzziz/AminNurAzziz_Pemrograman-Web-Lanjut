<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Using a closure-based composer for all views
        View::composer('*', function ($view) {
            $user = auth()->user();

            // Checking if the user is logged in before accessing properties
            if ($user) {
                Log::info('View composer executed: ' . $user->profile_picture);
            } else {
                Log::info('View composer executed: No user logged in');
            }

            // Pass the user object to all views, could be null if no user is logged in
            $view->with('user', $user);
        });
    }
}
