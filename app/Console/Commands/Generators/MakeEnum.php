<?php

namespace App\Console\Commands\Generators;

use Illuminate\Console\GeneratorCommand;

/**
 * Class MakeEnum
 * @package App\Commands
 */
class MakeEnum extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:enum {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create enum file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Enum file';

    /**
     * Get the name input for the command.
     *
     * @return array|string
     */
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
        return base_path() . '/Stubs/enum.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace . '\Enums';
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace(): string
    {
        return 'App';
    }
}

