<?php

namespace App\Providers;

use App\Debugbar\GraphQL;
use Illuminate\Support\ServiceProvider;

class DebugbarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $debugbar = app('debugbar');
        if (!$debugbar) {
            return;
        }

        $debugbar->addCollector(new GraphQL());
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
