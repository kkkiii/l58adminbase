<?php

namespace App\Console\Commands;

use App\My\AMQP;
use Illuminate\Console\Command;
use App\My\MyStr ;
class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:m{argv*}';

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
//        $params = ($this->argument('argv')) ;
//
//        foreach ($params as $item){
//            print_r( json_decode (json_encode($item)) ) ;
//        }


  print_r( MyStr::gen_random_num_cd(32));

  $data =[
      'a'=>'sdfsd士大夫a',
      'b'=>'sdfsd士大夫b',
      'c'=>'sdfsd士大夫c',
  ] ;

$res =   AMQP::sender(json_encode($data),"testq") ;

dump($res) ;


    }
}
