<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LogoutAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logouts:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Logout Admin';

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
     * @return mixed
     */
    
    public function handle()
    {
        $this->info('Hello Admin');
    }
}
