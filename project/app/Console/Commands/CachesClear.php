<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CachesClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'allcaches:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Caches Clear';

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
        $this->info('Caches Clear');
    }
}
