<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
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

        view()->composer(
            'navigation-menu', 
            function ($view) {
                $view->with(
                    [
                        'questions' => Question::all(),
                        'notifications' => Notification::whereJsonContains('users_to->'.Auth::id(), ['read' => 0])->get()
                    ]
                );
            }
        );

    }
}
