<?php

namespace App\My;
use PhpAmqpLib\Connection\AMQPStreamConnection ;
use PhpAmqpLib\Message\AMQPMessage ;

class AMQP
{


    static public function sender($data,$q_name)
    {
//        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
//        $connection = new AMQPStreamConnection('172.16.16.130', 30000, 'guest', 'guest');

        $connection = AMQPStreamConnection::create_connection(
            MyConstant::$amqp_cluster
        );
        $channel = $connection->channel();

        try {
            $channel->queue_declare($q_name, false, true, false, false);
            $msg = new AMQPMessage(
                $data,
                ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
            );
            $channel->basic_publish($msg, '', $q_name);
            return true;
        } catch (\Exception $e) {
            return false;
        }finally{
            $channel->close();
            $connection->close();
        }
    }

    static public function publish($data,$topic){
        $connection = AMQPStreamConnection::create_connection( MyConstant::$amqp_cluster
        );

        $channel = $connection->channel();

        try {
            $channel->exchange_declare($topic, 'fanout', false, false, false);
            if (empty($data)) {
                return false ;
            }
            $msg = new AMQPMessage($data, ['content_type' => 'text/plain', 'content_encoding' => 'utf-8']);
            $channel->basic_publish($msg, $topic);
            return true ;
        } catch (\Exception $e) {
            return false ;
        }finally{
            $channel->close();
            $connection->close();
        }

    }
}