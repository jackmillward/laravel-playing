<?php

namespace App\Providers;

use App\Contracts\Services\SuggestionsServiceInterface;
use App\Services\SuggestionsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SuggestionsServiceInterface::class, SuggestionsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
