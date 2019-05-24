<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class EmitLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emit:log{argv*}';

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
            ['host' => "172.16.16.130", 'port' => '30000', 'user' => 'guest', 'password' =>  'guest'],
                ['host' => "172.16.16.130", 'port' => '30002', 'user' => 'guest', 'password' =>  'guest'],
                ['host' => "172.16.16.130", 'port' => '30004', 'user' => 'guest', 'password' =>  'guest'],
        ]
       );



        $channel = $connection->channel();

        $channel->exchange_declare('logs', 'fanout', false, false, false);

        $data = implode(' ', $this->argument('argv'));


        if (empty($data)) {
            $data = "info: Hello World!";
        }
        $msg = new AMQPMessage($data, ['content_type' => 'text/plain', 'content_encoding' => 'utf-8']);

        $channel->basic_publish($msg, 'logs');

        echo ' [x] Sent ', $data, "\n";

        $channel->close();
        $connection->close();
    }
}
