<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CleanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean inside of framework (Generalnaya uborka 🧹)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('🧹 Running cache:clear');
        Artisan::call('cache:clear');

        $this->info('🧹 Running config:clear');
        Artisan::call('config:clear');

        $this->info('🧹 Running debugbar:clear');
        Artisan::call('debugbar:clear');

        $this->info('🧹 Running event:clear');
        Artisan::call('event:clear');

        $this->info('🧹 Running route:clear');
        Artisan::call('route:clear');

        $this->info('🧹 Running telescope:clear');
        Artisan::call('telescope:clear');

        $this->info('🧹 Running view:clear');
        Artisan::call('view:clear');

        $this->info('🧹 Running auth:clear-resets');
        Artisan::call('auth:clear-resets');

        return 0;
    }
}
