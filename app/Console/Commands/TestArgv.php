<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestArgv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test_argv:m{argv*}';

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
     * @return mixed
     */
    public function handle()
    {
        $params = ($this->argument('argv')) ;
        var_dump($params) ;
//
        foreach ($params as $item){
            print_r( $item ) ;
        }
    }
}
