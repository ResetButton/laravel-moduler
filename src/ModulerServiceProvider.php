<?php

namespace ResetButton\Moduler;

use Illuminate\Support\ServiceProvider;
use ResetButton\Moduler\Console\Commands\CreateModule;

class ModulerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateModule::class
            ]);
        }
    }
}
