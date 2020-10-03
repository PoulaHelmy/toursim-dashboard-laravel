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
        //Excursion Repository Files
        $this->app->bind(
            'App\Http\Repository\Interfaces\ExcursionsRepositoryInterface',
            'App\Http\Repository\Eloquent\ExcursionsRepository'
        );

        //Packages Repository Files
        $this->app->bind(
            'App\Http\Repository\Interfaces\PackagesRepositoryInterface',
            'App\Http\Repository\Eloquent\PackagesRepository'
        );

        //Categories Repository Files
        $this->app->bind(
            'App\Http\Repository\Interfaces\CategoriesRepositoryInterface',
            'App\Http\Repository\Eloquent\CategoriesRepository'
        );

        //Destinations Repository Files
        $this->app->bind(
            'App\Http\Repository\Interfaces\DestinationsRepositoryInterface',
            'App\Http\Repository\Eloquent\DestinationsRepository'
        );
    }//END OF register

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


    }//END OF BOOT
}//END OF CLASS
