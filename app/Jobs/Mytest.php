<?php

namespace App\Jobs;

use App\Vo\Vo1;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log ;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Str ;
class Mytest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    protected $vo;
  /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Vo1 $vo)
    {
        Log::debug('|||' . ' in construct:' . $vo->howmany . '|||');
        $this->vo =$vo;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $counter =  $this->vo->howmany ;

        $arr_container = [] ;


            for ($i = 0 ; $i < $counter ;$i ++)
            {

                array_push($arr_container ,['title'=>Str::orderedUuid()]) ;

                if ($i % 50 == 0)
                {
                    $this->other_process($arr_container) ;
                    $arr_container = [] ;
                }

            }

            if (!empty($arr_container))
            {
                $this->other_process($arr_container) ;
            }


    }
    public function other_process($data)
    {
        DB::table('tab1')->insert(
//                    ['title' => 'john@example.com' .  $k]
            $data
        );
    }


}
