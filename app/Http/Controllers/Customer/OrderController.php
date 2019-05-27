<?php

namespace App\Http\Controllers\Customer;
use App\Biz\Cart;
use App\Model\CodeTagType;
use App\Model\CodeView;
use App\Model\Order;
use App\Model\Org;
use App\Model\SyGood;
use App\My\MyStr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Biz\ShippingAddress ;
use Illuminate\Support\Facades\Auth;
use App\Model\Dict\DictSecondProd ;
use Illuminate\Support\Facades\Redis;
use App\My\Helpers ;
use Illuminate\Support\Facades\DB ;
use DateTime ;
use Illuminate\Support\Arr ;
class OrderController extends CustomerBase
{
    protected static  $cats ="carts:user" ;
    public function list(){
        parent::haveto_login() ;
//        $orders = Order::paginate(10);
$company = parent::get_bind_company() ;

        $orders = DB::table('orders')
            ->join('v_order_detail_sum', 'v_order_detail_sum.ordid', '=', 'orders.id')
            ->join('dict_ord_flowstops', 'orders.flow_stop', '=', 'dict_ord_flowstops.cd')
            ->select(
                'orders.id',
                'orders.our_sn',
                'orders.ali_sn',
                'orders.wst_company_id',
                'orders.flow_stop',
                'orders.tot_money',
                'orders.updated_at',
                'orders.created_at',
                'orders.province_cd',
                'orders.province',
                'orders.city_cd',
                'orders.city',
                'orders.district_cd',
                'orders.district',
                'orders.addr_detail',
                'v_order_detail_sum.tot_cash_sum',
                'v_order_detail_sum.tot_howmany',
                'dict_ord_flowstops.title as flowstop'
            )
            ->where([
                'wst_company_id'=>$company->id
            ])
            ->paginate(15)
;

//        dd($orders) ;


//        foreach ($orders as $value){
//            dd($value) ;
//        }


        return view('customer.order.list' ,compact('orders')) ;
    }
    public function create($id){
        parent::haveto_login() ;


        $template = CodeView::find($id);
        $codetypes = CodeTagType::all() ;



        return view('customer.order.create' ,compact('template' )) ;
    }
    public function create1(Request $request){
        parent::haveto_login() ;
        $data = $this->validate($request,[
            'code_amount' => 'required|integer|min:1',
            'unit_price'=>'required|integer',
            'id'=>'required|integer',
            'templatename'=>'required',
        ]) ;

//        dd($data) ;
//
//
//        $set2redis = $data ;
//        $set2redis = $request->post();
//
//         unset($set2redis['_token']) ;

        $cuser = parent::get_user() ;
        $data['uid'] = $cuser->id ;
        $data['tag_type'] = 1 ;

//        Redis::command('SET', [static::$cats . ":" .$cuser->id . ":goods" .$set2redis['sy_goods_id'] , json_encode($set2redis)]);


Cart::push2cart($data) ;


        return redirect(route('template.list') ) ;



//        $product =
//            Product::where([
//                'id'=>$request->post('product_id')
//
//            ])
//                ->first();
//
//        $data['code_type'] = 1 ;
//
//        $product_price =
//            ProductPrice::where([
//                'id'=>$data['code_type']
//            ])
//                ->first();
//        $ord_amt = $data['code_amount'] ;
//
//       $addrs = ShippingAddress::addr_options(Auth::id()) ;
//
//        return view('customer.order.create1' ,compact('product' , 'product_price','ord_amt','addrs')) ;

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
        parent::haveto_login() ;
        $ord = Order::find($id) ;

        return redirect(url('/customer/order.choose/' .$ord->our_sn )) ;
    }
    public function cart2ord(Request $reques){
        parent::haveto_login() ;

       $uid = parent::get_user()->id ;

       $cart = Cart::retrive2checkout($uid) ;

       if(empty($cart))
       {
           session()->flash(
               'danger','购物车是空的'
           ) ;
           return redirect(route('customer.home')) ;
       }


       $addrs = ShippingAddress::addr_options($uid) ;

        $filtered = Arr::where($addrs, function ($value, $key) {
            return ($value->is_default== 1);
        });

        $sel =count(data_get($filtered, '*.id')) > 0 ? data_get($filtered, '*.id')[0] :0 ;

        foreach ($cart as $item){
            $item->unit_price = $item->unit_price /100 ;
        }

        return view('customer.order.cart2ord2',['arr'=>$cart,'addrs'=>$addrs,'selected'=> $sel]);

//        return view('customer.order.cart2ord2' ,['uid'=>$uid ,'cart'=>$cart ,'addrs'=>$addrs]) ;
    }
    public function cart2ord_post(Request $request){
        parent::haveto_login() ;

        $params = $request->post() ;



        $uid = parent::get_user()->id ;
        $cart = Cart::retrive2checkout($uid) ;


        if(empty($cart))
        {
            session()->flash(
                'danger','购物车是空的'
            ) ;
            return response()->json([
                'cd'=>-1,
                'url' =>url('/customer/home'  )
            ]);
        }


        foreach ($params['pvalue'] as $value){
            DB::connection()->table('cart')
                ->where('templateid', $value['id'])
                ->update(['code_amount' => $value['count']]) ;
        }


        $tot = Cart::sum_tot($uid) ;
        // create ord_details and order

       $addr_id = $params['addr'];
        $addr = \App\Model\ShippingAddress::find($addr_id) ;

        $wst_company = parent::get_bind_company() ;

        $order =new Order();

        $order->wst_company_id =$wst_company->id;
        $order->our_sn = MyStr::create_orderid() ;
        $order->tot_money = $tot[0]->tot ;
        $order->province_cd = $addr->province_cd ;
        $order->city_cd = $addr->city_cd ;
        $order->district_cd = $addr->district_cd ;
        $order->province = $addr->province;
        $order->city = $addr->city ;
        $order->district = $addr->district ;
        $order->addr_detail = $addr->addr_detail ;
        $order->save() ;

        $cart = Cart::retrive2checkout($uid) ;
        $cart = Helpers::objectToArray($cart) ;
//        $tot = Helpers::objectToArray($tot) ;

        $data = [] ;
//        $dt = new DateTime;
        foreach ($cart as $value)
        {
            $value = array_merge( $value ,['tag_type'=>1, 'pid'=>$order->id , 'created_at'=>date("Y-m-d H:i:s") , 'updated_at'=>date("Y-m-d H:i:s")  ] ) ;
            $data = array_merge( $data ,[$value] ) ;
        }


///*
        DB::table('ord_details')->insert(
            $data
        );

        DB::table('cart')->where([
            'uid'=>$uid
        ])->delete();

        // dump carts

//        redirect to pay
        return response()->json([
            'cd'=>1,
            'url' =>url('/customer/order.choose/' .$order->our_sn )
        ]);
//*/

//        return redirect(url('/customer/order.choose/' .$order->our_sn )) ;

    }


}
