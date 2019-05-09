<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
class NewTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new:task{argv*}';

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
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->queue_declare('task_queue', false, true, false, false);


        $data =  $this->argument('argv') ;

        if (empty($data)) {
            $data = "Hello World!";
        }else
            $data =  implode(' ', $data);



        $msg = new AMQPMessage(
            $data,
            array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
        );

        $channel->basic_publish($msg, '', 'task_queue');


        echo ' [x] Sent ', $data, "\n";


        $channel->close();
        $connection->close();
    }
}
