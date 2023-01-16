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
        $moduler->makeRouteComponent();
        $moduler->makeControllerComponent();
        $moduler->makeModelComponent();
        $moduler->makeRequestComponent();
        $moduler->makeResourceComponent();
        $moduler->makeSeederComponent();
        $moduler->makeUnitTestComponent();


        return Command::SUCCESS;
    }


}
