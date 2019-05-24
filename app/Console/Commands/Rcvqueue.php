<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
class Rcvqueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rcv:queue';

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

//        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

        $connection = AMQPStreamConnection::create_connection([
            ['host' => "172.16.16.130", 'port' => 30000, 'user' => 'guest', 'password' =>  'guest'],
            ['host' => "172.16.16.130", 'port' => 30002, 'user' => 'guest', 'password' =>  'guest'],
            ['host' => "172.16.16.130", 'port' => 30004, 'user' => 'guest', 'password' =>  'guest'],
        ],[]
        );

        $channel = $connection->channel();
        $channel->queue_declare('dispatch_ord', false, false, false, false);
        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };
        $channel->basic_consume('dispatch_ord', '', false, true, false, false, $callback);
        while (count($channel->callbacks)) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }
}
