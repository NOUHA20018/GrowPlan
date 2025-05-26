<?php

namespace App\Providers;

use App\Models\Cour;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::share('appName', 'Smart Growth');
        View::composer(['layoutsAdmin.sidebare','admin.dashboard'], function ($view) {
            $enAttenteCount = Cour::where('status', 'en attente')->count();
            $view->with('enAttenteCount', $enAttenteCount);
            $valideCount = Cour::where('status', 'valide')->count();
            $view->with('valideCount', $valideCount);
            $refuseCount = Cour::where('status', 'refuse')->count();
            $view->with('refuseCount', $refuseCount);
    });
    }
}
