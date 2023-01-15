<?php

namespace ResetButton\Moduler;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use ResetButton\Moduler\Console\Commands\CreateModule;

class ModulerServiceProvider extends ServiceProvider
{

    public function register()
    {
        $modulesFolder = 'modules';

        Router::macro('module', function ($moduleName, $routeFile = '') use ($modulesFolder) {
            $folderPath = base_path($modulesFolder . '/' . $moduleName . '/routes/');
            $path = $routeFile ? $folderPath.$routeFile.'.php' : $folderPath. $moduleName.'.php';
            require $path;
        });
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
