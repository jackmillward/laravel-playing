<?php

namespace App\Providers;

use App\Managers\SuggestionsManager;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class DriverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SuggestionsManager::class, fn (Application $application) => new SuggestionsManager($application));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
