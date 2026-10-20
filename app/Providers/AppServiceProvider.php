<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Services\PortfolioServiceInterface::class,
            \App\Services\PortfolioService::class
        );

        $this->app->bind(
            \App\Services\InquiryServiceInterface::class,
            \App\Services\InquiryService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
