<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\ServiceProviderInjector;
use Illuminate\Console\GeneratorCommand;

class ServiceMakeCommand extends GeneratorCommand
{
    use ServiceProviderInjector;

    protected $signature = 'make:service {name}';

    protected $description = 'Create a new Service class';

    public function handle()
    {

        return parent::handle();
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/service.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\\Services';
    }
}
