<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CustomServe extends Command
{
    protected $signature = 'custom:serve {--host=127.0.0.1} {--port=8000}';
    protected $description = 'Serve the application with custom options';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $host = $this->option('host');
        $port = $this->option('port');

        $this->info("Starting server on http://$host:$port");

        // Run the server command with custom options
        exec("php -S $host:$port -t public");
    }
}
