<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeOnPort80 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application in port 80';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('serve',[
            '--host' => env('RUN_ON_SERVER', 'localhost'),
            '--port' => env('RUN_ON_PORT', 80),
        ]);
    }
}
