<?php

namespace App\Http\Controllers\Customer;
use App\Biz\Cart;
use App\Model\Order;
use App\Model\Org;
use App\Model\SyGood;
use App\My\MyStr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product ;
use App\Model\ProductPrice ;
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
        $orders = Order::paginate(10);
        return view('customer.order.list' ,compact('orders')) ;
    }
    public function create($id){
        parent::haveto_login() ;

      $good =  SyGood::find($id) ;

       $dict2prod_item = DictSecondProd::find($good->sy_cate_id) ;

//       dump($dict2prod_item) ;

//      dd($good) ;

        return view('customer.order.create' ,compact('good' ,'dict2prod_item')) ;
    }
    public function create1(Request $request){
        parent::haveto_login() ;
        $data = $this->validate($request,[
            'code_amount' => 'required|integer|min:1',
//            'code_type'=>'required|digits:1',
        ]) ;




        $set2redis = $request->post();

         unset($set2redis['_token']) ;




        $cuser = parent::get_user() ;
        $set2redis['uid'] = $cuser->id ;

        Redis::command('SET', [static::$cats . ":" .$cuser->id . ":goods" .$set2redis['sy_goods_id'] , json_encode($set2redis)]);

Cart::push2cart($set2redis) ;

        return redirect(route('product.list') ) ;



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
        $ord = Order::find($id) ;

        return redirect(url('/customer/order.choose/' .$ord->our_sn )) ;
    }
    public function cart2ord(Request $reques){


       $uid = parent::get_user()->id ;

       $cart = Cart::retrive2checkout($uid) ;

//dd($cart) ;
        $addrs = ShippingAddress::addr_options($uid) ;

        return view('customer.order.cart2ord' ,['uid'=>$uid ,'cart'=>$cart ,'addrs'=>$addrs]) ;
    }
    public function cart2ord_post(Request $request){

        $uid = parent::get_user()->id ;

        $tot = Cart::sum_tot($uid) ;

        // create ord_details and order

       $addr_id =  $request->post('shipping_address') ;

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
        $dt = new DateTime;
        foreach ($cart as $value)
        {
            $value = array_merge( $value ,[ 'pid'=>$order->id , 'created_at'=>$dt->format('m-d-y H:i:s') , 'updated_at'=>$dt->format('m-d-y H:i:s')  ] ) ;

            $data = array_merge( $data ,[$value] ) ;

        }


        DB::table('ord_details')->insert(
            $data
        );

        DB::table('cart')->where([
            'uid'=>$uid
        ])->delete();

        // dump carts

//        redirect to pay

    }


}
