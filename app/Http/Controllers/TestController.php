<?php
namespace App\Http\Controllers;
use App\Biz\Area;
use App\Biz\Cart;
use App\Biz\Org;
use App\Car;
use App\Http\Controllers\Common\AreaController;
use App\Http\Controllers\Customer\CustomerBase;
use App\Jobs\SleepSeconds;
use App\Model\Customer;
use App\Model\Dict\DictOrdFlowstop;
use App\Model\Module;
use App\Model\WST\YqCompanyUser;
use App\My\Helpers;
use App\My\MyAuth;
use App\Vo\CodeGenVo;
use App\Vo\Vo1;
use Faker\Provider\HtmlLorem;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
//use Illuminate\Support\Facades\Redis;
//use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB ;
use Illuminate\Support\Facades\Redis ;
use App\Biz\PCACodeBiz ;
use App\My\Category ;
use App\My\Menu ;
use IntlChar ;
use App\My\MyStr ;
use Illuminate\Support\Str ;
use Illuminate\Support\Arr;
use App\Model\CodeTagType ;
use App\Biz\ShippingAddress ;
use Illuminate\Support\Facades\Queue ;
use Illuminate\Support\Facades\Mail ;
use Illuminate\Support\Facades\Log ;
use App\Jobs\CodeGen ;
use Pay;
use App\Model\OrdDetail ;
class TestController extends CustomerBase
{
    public function t1(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email'
//        ]);
//
//        $input = $request->all();

        dump(session('cnpy_user') ) ;
        dump(session('cnpy_user')->id ) ;
//      dump($ord_details) ;




dd(  parent::get_user()->id) ;
        dump(!is_null(session('admin')['uname']));
        dump(Auth::guest()) ;
        dump(Auth::id()) ;

dd(12) ;
        $date1 = "2014-11-11";
        $var = strtotime($date1) ;
       Helpers::p($var)   ;
        Helpers::p(
          (date('Ymd',$var))
    )   ;
print_r("==================================" ) ;
        $sn =  strrev( (Helpers::gen_random_datenum_cd(16)))  ;
     var_dump($sn)  ;
        $rev_sn = strrev($sn) ;
      $int_str =  substr($sn,6) ;
      var_dump(date('Y-m-d',intval($int_str))) ;


        $vector = new \Ds\Vector();

        $vector->push('a');
        $vector->push('b', 'c');

        $vector[] = 'd';

        print_r($vector);

     var_dump( sha1("G@DhbhhGKR9131641542609436"))   ;


//        return response()->json($car);
    }

    public function t2()
    {

        $uid = parent::get_user()->id ;
      $res =   Cart::header_show_count($uid) ;
      dd($res) ;

//        Redis::command('DECR',['aa']) ;
//
//        $data = [
//            "a" =>1 ,
//            "b" =>3 ,
//        ] ;
//        return response()->json(Helpers::build_rest_res(1,$data));

       $history =  "上地,咖啡,猪肉,走吧" ;



//      $rec =  DB::connection('mysql_user')->table("customer_locate_city")->where('customer_id', 1)->first() ;
//      var_dump($rec->chosen_city) ;
//
//     $no =  Helpers::gen_random_datenum_cd(16) ;
//
//     var_dump($no) ;

//print_r(base64_encode('9131641542609436')) ;

        echo "今天:",date("Y-m-d H:i:s",time()),"<hr>";

        $d_str = date("Y-m-d H:i:s",time()) ;

//        $rec =  DB::connection('mysql_user')->table('customer_order')->where([
//            'order_no'=>'9131641542609436',
//            'id'=>1
//        ])->update(
//            [
//'checking_no' => Helpers::gen_random_datenum_cd(16) ,
//'checking_time' =>$d_str
//            ]
//        );
//
//        var_dump($rec) ;

    }
    public function t3(Request $request){

//     $content =   $request->getContent() ;
//     var_dump(32) ;

//        $val =   Redis::get("aa") ;
//        var_dump($val) ;

//        echo url('user/profile', [1]);



//        var_dump( );
//      $rtn =  Redis::HMSET('hmset',(json_decode($json,true))) ;
//
//      var_dump($rtn) ;
//        PCACodeBiz::provinces_set() ;
//        PCACodeBiz::cities_set() ;
//        PCACodeBiz::areas_set() ;
//        $rtn =   PCACodeBiz::areas_get("110105") ;
//
//        var_dump($rtn) ;

//        Menu::gen_menu() ;

//        $a = DB::select("select version()") ;

        $str="/2";//此时可以用单引号
//        var_dump( IntlChar::isdigit( trim($str,'/'))  );

//        var_dump(  IntlChar::isdigit(trim($str,'/')) );

//        $org = Org::retrive_item(44) ;
//        dd($org) ;

//        dd( MyStr::create_orderid() );
       $items = DictOrdFlowstop::all() ;
        dump($items);


    }

    public function t4(Request $request){
//      Helpers::p(Area::q_name( '120115', 'dict_areas') )  ;
//        $uid = Auth::id() ;
//
//
//        $addrs = ShippingAddress::addr_options($uid) ;
//        Helpers::p($addrs) ;

//        $sql = <<<EOD
//SELECT VERSION()
//EOD;
//        $tree_nodes = DB::connection('mysql_wst')
//            ->select($sql);
////
//        Helpers::p($tree_nodes) ;
//        dd ( DB::connection('mysql_wst')->select('select version()') );

//        $user = YqCompanyUser::find(2000021) ;
//
//        var_dump($user->password) ;

//        dd($user->id) ;

          $this->dispatch(new CodeGen(new CodeGenVo(10000,1,1,1,'code2')));

         echo '1' ;

//        $this->dispatch(new Mytest($reader->toArray()));

    }

    public function t5(Request $request){

//        Helpers::p($array) ;

        $modules =collect (DB::select('SELECT * from v_admin_id2modules where admin_id = 1'));


        $menus_array  = $modules->pluck('menus')->map(function ($item, $key) {
            return json_decode($item);
        })->flatten ()->all();

        $routes_array  = $modules->pluck('routes')->map(function ($item, $key) {
            return json_decode($item);
        })->flatten ()->all();

        Helpers::p($routes_array) ;


        die() ;


//        $module = Module::first() ;
//
//
//       var_dump(json_decode($module->menus)) ;
//
//        var_dump(json_decode($module->routes)) ;



//        die() ;
        $sql = <<<EOD
SELECT
menus.id,
menus.parentid,
menus.title,
menus.action
FROM
menus

EOD;
        $tree_nodes = DB::connection()
            ->select($sql);

        $arr = Helpers::objectToArray($tree_nodes) ;
        $resut =  Category::unlimitedForlayer($arr) ;

        Helpers::p($resut) ;
die() ;

        return view('admin.t5') ;
    }

    public function t6(Request $request){


//      $rest =  Redis::set('name', 'Taylor');
         $rest =  Redis::get('mobile.reg:15738808900');
         dd($rest) ;

//        Redis::lpush('runoob:1', 'redis');
//        Redis::lpush('runoob:1', 'mongo');
//        Redis::lpush('runoob:1', 'mysql');
//
//        Helpers::p(Redis::LRANGE('runoob:1',0,10) ) ;

//        Redis::sadd ('s1' ,'a');
//        Redis::sadd ('s1' ,'a');
//        Redis::sadd ('s1' ,'b');
//        Redis::sadd ('s1' ,'b');



//        Helpers::p(Redis::SMEMBERS('s1')) ;

//        Helpers::p(Redis::get('name') ) ;

        $allow_arr  = (session('allow_routes')) ;
//        $route =  MyStr::purify_admin_url() ;
//        $route2 =  MyStr::purify_url_without_host() ;
//            Helpers::p($allow_arr) ;


//            foreach ($allow_arr as $key=>$item){
//
//                Redis::lpush('allow_routes:'.Auth::id(), $item);
//            }

//        Helpers::p( Redis::lrange('allow_routes:'.Auth::id(), 0,-1)) ;
//        Redis::DEL("allow_routes:65") ;

//       var_dump(session()) ;

//            Helpers::p($route) ;
//            Helpers::p($route2) ;
//        $instr = 'opt1' ;
//        $what = Str::replaceFirst( 'opt' , '' ,$instr ) ;
//      Helpers::p( $what );
//
//      $arr = [] ;
//      array_push( $arr ,1) ;array_push( $arr ,2) ;array_push( $arr ,3) ;
//
//      var_dump(session('uname')) ;
//        $menus  = (session('menus_ids')) ;
//        Helpers::p($menus) ;

    }
    public function tree(Request $request){

        $sql = <<<EOD
SELECT
org.id,
org.org_name text,
org.parentid,
org.province_id,
org.province,
org.city_id,
org.city,
org.district_id,
org.district,
org.sort
FROM
org
ORDER BY sort 

EOD;
        $tree_nodes = DB::connection()
            ->select($sql);

        $arr = Helpers::objectToArray($tree_nodes) ;
        $res =  Category::unlimitedForlayer($arr,'items') ;

//        die() ;

       return view("test.tree",compact('res')) ;
    }
    public function t7(Request $request){
      $customer =  Customer::find(1) ;
      var_dump($customer->company->cname) ;

    }
    public function params(Request $request){

       var_dump($request->query('f1')) ;
        var_dump($request->query('f2')) ;
        var_dump($request->query('f3'));
        $recs = CodeTagType::all() ;
        dd($recs) ;

    }
    public function alipay(Request $request)
    {

        //唯一的订单号
        $out_trade_no       = '20160122';
        //订单名称
        $subject            = 'xxxxxxxxxxx';
        //付款金额
        $total_fee          = '0.01';
        //订单描述
        $body               = 'xxxxxxxxxxx';
        $show_url           = '';
        $anti_phishing_key  = '';
        $exter_invoke_ip    = $request->getClientIp();
        $parameter = [
            "service"           => config('lxu-alipay.pcconfig.service'),
            "partner"           => trim(config('lxu-alipay.pcconfig.partner')),
            "seller_id"         => trim(config('lxu-alipay.pcconfig.seller_id')),
            "payment_type"      => config('lxu-alipay.pcconfig.payment_type'),
            "notify_url"        => config('lxu-alipay.pcconfig.notify_url'),
            "return_url"        => config('lxu-alipay.pcconfig.return_url'),
            "seller_email"      => config('lxu-alipay.pcconfig.seller_email'),
            "out_trade_no"      => $out_trade_no,
            "subject"           => $subject,
            "total_fee"         => $total_fee,
            "body"              => $body,
            "show_url"          => $show_url,
            "anti_phishing_key" => $anti_phishing_key,
            "exter_invoke_ip"   => $exter_invoke_ip,
            "_input_charset"    => trim(strtolower(config('lxu-alipay.pcconfig.input_charset')))
        ];
        $pc =  app('PcAlipay');
        $html_text = $pc->buildRequestForm($parameter,"post", "确认");
        echo $html_text;
    }
    public function qr_code(Request $request)
    {
//      $res =  Storage::get('path/to/image.png') ;

//        echo asset('pics/LOGO1mdpi.png');
//      dd() ;
        return view('test.qr_code') ;
    }
}
