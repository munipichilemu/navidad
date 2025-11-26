<?php

namespace App\Providers;

use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        FilamentIcon::register([
            'panels::pages.dashboard.navigation-item' => 'fas-chart-simple',
            'panels::topbar.open-database-notifications-button' => 'far-bell',
            'notifications::database.modal.empty-state' => 'far-circle',
        ]);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
