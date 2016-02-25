<?php

namespace App\Providers;

use App\Domain\Repository\UserRepository;
use App\Infrastructure\Repository\UserRepositoryOnArray;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->environment() === 'heroku') {
            app('log')->useFiles('php://stdout');
        }
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepositoryOnArray::class);
    }
}
