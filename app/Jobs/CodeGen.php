<?php
namespace App\Jobs;
use App\Vo\CodeGenVo;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log ;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Str ;
class CodeGen implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vo;
  /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CodeGenVo $vo)
    {
        $this->vo =$vo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {



            for ($i = 0 ; $i <  $this->vo->howmany  ;$i ++)
            {

                $ins_db = [
                    'sn'=>Str::orderedUuid() ,
                'wst_company_id'=>$this->vo->company_id ,
                    'templateid'=>$this->vo->goods_id,
                      'ord_detail_id'=>$this->vo->order_id,
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s")
                ] ;




                DB::table($this->vo->table_name)->insert(
                    $ins_db
                        );

                unset($ins_db) ;
                }


    }



}
