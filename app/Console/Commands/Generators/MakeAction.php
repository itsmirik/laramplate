<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\GeneratorCommand;

/**
 * Class MakeAction
 * @package App\Commands
 */
class MakeAction extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:action {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create action file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Action file';

    protected function getNameInput(): array|string
    {
        return str_replace('.', '/', trim($this->argument('name')));
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return base_path() . '/Stubs/action.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Actions';
    }
}
