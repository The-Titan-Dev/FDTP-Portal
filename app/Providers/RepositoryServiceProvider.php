<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Register Interface and Repository in here
        // You must place Interface in first place
        // If you dont, the Repository will not get readed.
        $this->app->bind(
            'App\Interfaces\UserInterface',
            'App\Repositories\UserRepository',

        );
        $this->app->bind(
            'App\Interfaces\SystemsInterface',
            'App\Repositories\SystemsRepository'
        );

        $this->app->bind(
            'App\Interfaces\RoleInterface',
            'App\Repositories\RoleRepository'
        );

        $this->app->bind(
            'App\Interfaces\SystemRestrictionInterface',
            'App\Repositories\SystemRestrictionRepository'
        );

        $this->app->bind(
            'App\Interfaces\SystemAccessInterface',
            'App\Repositories\SystemAccessRepository'
        );

        $this->app->bind(
            'App\Interfaces\ContactInterface',
            'App\Repositories\ContactRepository'
        );

        $this->app->bind(
            'App\Interfaces\ImageInterface',
            'App\Repositories\ImageRepository'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
