<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Aspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aspire:api';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo "Database Migration Started-----------------------\n";
        Artisan::call('migrate');
        echo Artisan::output();
        echo "Database Migration Completed----------------------\n";
        echo "Starting Laravel development server: http://127.0.0.1:8000";
        Artisan::call('serve');
    }
}
