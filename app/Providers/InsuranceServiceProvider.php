<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\InsuranceAPI\InsuranceCalc;

use Illuminate\Http\Request;

class InsuranceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\InsuranceAPI\InsuranceCalc', function ()
            {
                return new InsuranceCalc();
            }
        );
    }
}
