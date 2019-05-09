<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order ;
use App\Vo\CodeGenVo ;
use App\Jobs\CodeGen ;
use Illuminate\Support\Facades\DB ;
class OrderController extends AdminBase
{
    public function list()
    {
        parent::check_module();

        $orders = Order::paginate(10);

        return view('admin.order.list',compact('orders'));
    }
    public function shoot($id){
        // 更新 order 为已派发

        $ord = Order::find($id);
        $ord->flow_stop =2;
        $ord->save();


        $ord_details =  OrdDetail::where([
            'pid'=>1
        ])
            ->get()
        ;


        foreach ($ord_details as $item) {

            $goods_id =  $item->sy_goods_id ;
            $ord_detail_id = $item->id  ;
            $company_id = $ord->wst_company_id ;

            $this->dispatch(new CodeGen(new CodeGenVo($ord->code_amount,$company_id,$goods_id,$ord_detail_id,'code' . $item->tag_type)));
        }



        // 射 到后台任务慢慢生成数据
        // 告诉他  已经进入队列了

        session()->flash(
            'success','已经派发了'
        ) ;

        return redirect(('/admin/order.list'));

    }
}
