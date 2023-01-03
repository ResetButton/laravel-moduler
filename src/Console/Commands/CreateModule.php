<?php

namespace ResetButton\Moduler\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use ResetButton\Moduler\Moduler;

class CreateModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module';

    private const FOLDERS = [];

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function handle()
    {

        $moduleName = trim($this->argument('name'));

        $moduler = new Moduler($moduleName);
        $moduler->makeStubComponent('Controller', 'vendor/laravel/framework/src/Illuminate/Routing/Console/stubs/controller.plain.stub');
        $moduler->makeStubComponent('Model', 'vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/model.stub');
        $moduler->makeStubComponent('Request', 'vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/request.stub');
        $moduler->makeStubComponent('Resource', 'vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/resource.stub');
        $moduler->makeStubComponent('seeder', 'vendor/laravel/framework/src/Illuminate/Database/Console/Seeds/stubs/seeder.stub');
        $moduler->makeStubComponent('tests/Unit', 'vendor/laravel/framework/src/Illuminate/Foundation/Console/stubs/test.stub');

        return Command::SUCCESS;
    }


}
