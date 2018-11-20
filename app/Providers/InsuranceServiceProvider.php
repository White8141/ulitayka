<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\InsuranceAPI\InsuranceCalc;

class InsuranceServiceProvider extends ServiceProvider
{
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
