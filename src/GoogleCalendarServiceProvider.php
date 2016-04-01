<?php

namespace Szabomikierno\GoogleCalendarLaravelWrapper;

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

        $this->publishes([
            __DIR__ . '/../config/GoogleCalendar.php' => \config_path('GoogleCalendar.php'),
        ], 'config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/../vendor/autoload.php';

        $credentials = config('GoogleCalendar.credentials');

        $client = new \Google_Client;

        $this->app->bind("Szabomikierno\GoogleCalendarLaravelWrapper\GoogleCalendar", function() use ($client, $credentials) {
            return new GoogleCalendar($client, $credentials);
        });

    }
}
