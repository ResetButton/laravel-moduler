<?php

namespace ResetButton\Moduler;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use ResetButton\Moduler\Moduler;
use ResetButton\Moduler\Console\Commands\CreateModule;

class ModulerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $modulesFolder = 'modules';

        //Implement Route::module macros
        Router::macro('module', function ($moduleName, $routeFile = '') use ($modulesFolder) {
            $folderPath = base_path($modulesFolder . '/' . $moduleName . '/routes/');
            $path = $routeFile ? $folderPath.$routeFile.'.php' : $folderPath. $moduleName.'.php';
            require $path;
        });

        //load configs
        foreach (self::getModulesList() as $moduleName) {
            $configPath = base_path($modulesFolder.'/'.$moduleName.'/config/'.$moduleName.'.php');
            if (File::exists($configPath)) {
                config([strtolower($moduleName) => require $configPath]) ;
            }
        }
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

    public static function getModulesList() : array
    {
        $modulesFolder = 'modules';
        $modules = File::directories(base_path($modulesFolder . '/'));
        $modules = array_map(
            fn($value) => str_replace(base_path($modulesFolder . '/'),'', $value),
            $modules,

        );
        return $modules;
    }


}
