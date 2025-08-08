<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        Event::listen(Registered::class, function ($event) {
            $event->user->assignRole('user');
        });

    }
}
