<?php

namespace App\Providers;

use App\Models\Cour;
use App\Models\Notification;
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
        View::composer(('welcome'),function($view){
        $lastCourse = Cour::orderBy('id', 'desc')->take(3)->get();
        $view->with('lastCourse', $lastCourse);
        });
        View::composer(['layoutsAdmin.sidebare','admin.dashboard'], function ($view) {
            $enAttenteCount = Cour::where('status', 'en attente')->count();
            $view->with('enAttenteCount', $enAttenteCount);
            $valideCount = Cour::where('status', 'valide')->count();
            $view->with('valideCount', $valideCount);
            $refuseCount = Cour::where('status', 'refuse')->count();
            $view->with('refuseCount', $refuseCount);
            $notificationsCount = Notification::all()->count();
            $view->with('notificationsCount', $notificationsCount);
    });
    }
}
