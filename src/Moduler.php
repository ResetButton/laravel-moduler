<?php

namespace ResetButton\Moduler;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Output\ConsoleOutput;

class Moduler
{

    private string $modulesFolder;
    private string $moduleName;
    private string $packagePath;

    public function __construct(string $moduleName, string $folder = 'modules')
    {
        $this->moduleName = $moduleName;
        $this->modulesFolder = base_path($folder);
    }

    public function makeRouteComponent(): bool
    {
        return $this->makeStubComponent('route', __DIR__ . '/Console/stubs/route.stub');
    }

    public function makeStubComponent(string $moduleComponent, string $stubPath) : bool
    {
        //Check stub
        $fullStubPath = base_path(str_replace(base_path().'/', '', $stubPath));
        if (!File::exists($fullStubPath)) {
            throw new FileNotFoundException('Stub not found at '. $fullStubPath);
        }

        //Create structure
        $moduleComponentFolder = strpos($moduleComponent, '/') ? $moduleComponent : $moduleComponent . 's'; //if there no subfolder - add 's' at the end
        File::ensureDirectoryExists($this->modulesFolder . '/' . $this->moduleName . '/' . $moduleComponentFolder);

        //Replacing placeholders in stub
        $stub = file_get_contents($fullStubPath);
        $stub = str_replace('{{ namespace }}', 'Modules\\' . $this->moduleName . '\\' . str_replace('/', '\\', $moduleComponentFolder), $stub);
        $stub = str_replace('{{ rootNamespace }}', 'App\\', $stub);
        $stub = str_replace('{{ class }}', $this->moduleName, $stub);

        //Write results

        $moduleComponentPath = $this->modulesFolder . '/' . $this->moduleName .'/'. $moduleComponentFolder . '/' . $this->moduleName . '.php';
        $result = File::put($moduleComponentPath, $stub);

        if (app()->runningInConsole()) {
            $output = new ConsoleOutput();
            $output->writeln("<info>Successfully created ". $moduleComponent." at ". $moduleComponentPath ."</info>");
        }

        return $result;
    }



    public function getModulesFolder() : string
    {
        return $this->modulesFolder;
    }
}
