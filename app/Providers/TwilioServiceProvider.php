<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Services_Twilio_RequestValidator;

class TwilioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Services_Twilio_RequestValidator::class, function () {
            return new Services_Twilio_RequestValidator(config('twilio.auth_token'));
        });
    }
}
