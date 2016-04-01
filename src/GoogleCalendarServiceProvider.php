<?php

namespace Szabomikierno\GoogleCalendarL5Wrapper;

use Illuminate\Support\ServiceProvider;

class GoogleCalendarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app['googlecalendar'] = $this->app->share(function ($app) {
            return new GoogleCalendarWrapper;
        });
    }
}
