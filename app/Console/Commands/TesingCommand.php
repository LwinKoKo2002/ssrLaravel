<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TesingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:command';

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
        sleep(2);
        info("Sorry, this is not right time");
        info("Sorry, this is not right time");
        info("Sorry, this is not right time");
        return 0;
    }
}
