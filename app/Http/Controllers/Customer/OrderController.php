<?php

namespace App\Http\Controllers\Customer;

use App\Model\Order;
use App\Model\Org;
use App\My\MyStr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product ;
use App\Model\ProductPrice ;
use App\Biz\ShippingAddress ;
use Illuminate\Support\Facades\Auth;

class OrderController extends CustomerBase
{
    public function list(){
        parent::haveto_login() ;
        $orders = Order::paginate(10);
        return view('customer.order.list' ,compact('orders')) ;
    }
    public function create($id){
        parent::haveto_login() ;

//         $ord =new Order() ;
//         $ord->product_id = $id ;

        return view('customer.order.create' ,compact('id')) ;
    }
    public function create1(Request $request){
        parent::haveto_login() ;
        $data = $this->validate($request,[
            'code_amount' => 'required|integer|min:1',
//            'code_type'=>'required|digits:1',
        ]) ;


        $product =
            Product::where([
                'id'=>$request->post('product_id')

            ])
                ->first();

        $data['code_type'] = 1 ;

        $product_price =
            ProductPrice::where([
                'id'=>$data['code_type']
            ])
                ->first();
        $ord_amt = $data['code_amount'] ;

       $addrs = ShippingAddress::addr_options(Auth::id()) ;

        return view('customer.order.create1' ,compact('product' , 'product_price','ord_amt','addrs')) ;

    }


    public function create_post(Request $request){
        parent::haveto_login() ;


        // check multi submit

        $allready_ord =
            Order::where([
                'product_id'=>$request->post('product_id') ,
                'code_amount'=> $request->post('code_amount')  ,
                'code_type'=> $request->post('code_type')  ,
            ])
                ->first();

        if ($allready_ord)
        {
            session()->flash(
                'success','已经提交过了'
            ) ;
            return  redirect(route('order.list')) ;
        }

        $shipping_address =  $request->post('shipping_address') ;

        $addr = \App\Model\ShippingAddress::find($shipping_address) ;


        $wst_company = parent::get_bind_company() ;

        $order =new Order();
        $order->product_id = $request->post('product_id') ;
        $order->wst_company_id =$wst_company->id;
        $order->code_amount = $request->post('code_amount') ;
        $order->code_type = $request->post('code_type') ;
        $order->unit_price = $request->post('unit_price') ;
        $order->our_sn = MyStr::create_orderid() ;
        $order->tot_money = $order->code_amount * $order->unit_price ;
        $order->province_cd = $addr->province_cd ;
        $order->city_cd = $addr->city_cd ;
        $order->district_cd = $addr->district_cd ;
        $order->province = $addr->province;
        $order->city = $addr->city ;
        $order->district = $addr->district ;
        $order->addr_detail = $addr->addr_detail ;
        $order->save() ;

        return redirect('customer/order.choose/' . $order->our_sn) ;
    }
    public function del(Request $request,$id){
        parent::haveto_login() ;

        $allready_ord =
            Order::where([
                'id'=>$id ,
                'flow_stop'=>0
            ])
                ->delete();

//            session()->flash(
//                'success','删了'
//            ) ;
            return  redirect(route('order.list')) ;
    }
    public function pay(Request $request,$id){
       echo '将来对接支付' ;
    }
}
