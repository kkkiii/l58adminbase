<?php

namespace App\Console\Commands;
use App\Model\CodeView;
use Illuminate\Support\Facades\DB ;
use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Illuminate\Support\Str ;
class Subscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscribe:m{argv*}';

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

        if (empty($params))
            return  ;
        $topic  =($params[0]) ;


        $connection = AMQPStreamConnection::create_connection([
//                ['host' => "172.16.16.130", 'port' => '30000', 'user' => 'guest', 'password' =>  'guest'],
//                ['host' => "172.16.16.130", 'port' => '30002', 'user' => 'guest', 'password' =>  'guest'],
//                ['host' => "172.16.16.130", 'port' => '30004', 'user' => 'guest', 'password' =>  'guest'],
                ['host' => "172.16.16.10", 'port' => '5672', 'user' => 'zqlmadmin', 'password' =>  'zqlmadmin']
            ]
        );


        $channel = $connection->channel();

        $channel->exchange_declare($topic, 'fanout', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

        $channel->queue_bind($queue_name, $topic);

        echo " [*] Waiting for logs. To exit press CTRL+C\n";

        $callback = function ($msg) {

            $jobj = json_decode($msg->body ) ;

            $howmany = intval($jobj->howmany) ;
            $company_id = ($jobj->wst_company_id) ;
            $templateid = ($jobj->templateid) ;
            $ord_detail_id = ($jobj->ord_detail_id) ;

           $code_view =  CodeView::find($templateid) ;
            $code_view->is_edit = 1 ;
            $code_view->update();

            for ($i = 0 ; $i <  $howmany  ;$i ++)
            {

                $ins_db = [
                    'sn'=>Str::orderedUuid() ,
                    'wst_company_id'=>$company_id ,
                    'templateid'=>$templateid,
                    'ord_detail_id'=>$ord_detail_id,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ] ;

                DB::table('code1')->insert(
                    $ins_db
                );

                unset($ins_db) ;
            }


//            $res =  DB::connection()->table('tab1')->insert([
//                'title'=>$jobj->howmany
//            ]) ;
//            echo ' [x] ',( $ord_detail_id) , "\n";\
print_r("order_detail id:$ord_detail_id ,$howmany is done") ;
            print_r() ;

        };

        $channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

    }
}
