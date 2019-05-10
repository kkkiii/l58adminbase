<?php
namespace App\Http\Controllers\Customer;

use App\Model\ShippingAddress;
use App\My\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB  ;
use App\Biz\Area ;
class ShippingAddressController extends CustomerBase
{
    public function list_my(){
        parent::haveto_login() ;

       $address = ShippingAddress::where([
            'wst_login_id'=>Auth::id()
        ])
           ->orderBy('id', 'desc')
           ->get();

        return view('customer.my_address',compact('address')) ;
    }

    /**
     * id address id
     */
    public function edit($id){
        parent::haveto_login() ;
        $uid = Auth::id() ;

        parent::haveto_login() ;

        $address =
            ShippingAddress::where([
                'id'=>$id ,
                'wst_login_id'=>$uid
            ])
                ->first();
        $provinces = DB::table('dict_provinces')->pluck("name", "code");


        return view('customer.address_edit',compact('address','provinces')) ;

    }
    public function edit_post(Request $request){
        parent::haveto_login() ;

        $address = ShippingAddress::find($request->post('id'));

        $address->province =Area::q_name( $request->post('province') ,'dict_provinces')[0]->name;

        $address->city_cd = $request->post('city') ;
        $address->city =Area::q_name( $request->post('city') ,'dict_cities')[0]->name;

        $address->district_cd = $request->post('district') ;
        $address->district =Area::q_name( $request->post('district') ,'dict_areas')[0]->name;

        $address->addr_detail = $request->post('addr_detail') ;

        $r =  $address->save() ;

        return redirect(route('my_address.list')) ;
    }

    public function add(){
        parent::haveto_login() ;
        $uid = Auth::id() ;

//        $address =
//            ShippingAddress::where([
//                'id'=>$id ,
//                'customer_id'=>$uid
//            ])
//                ->first();
        $provinces = DB::table('dict_provinces')->pluck("name", "code");
        return view('customer.address_add',compact('provinces','uid')) ;

    }
    public function add_post(Request $request){

        parent::haveto_login() ;
        $data = $this->validate($request,[
            'province'=>'required|size:2',
            'city'=>'required|size:4',
            'district'=>'required|size:6',
            'addr_detail'=>'required',
        ]) ;


//        dd($request->post()) ;
        $addr = new ShippingAddress() ;
        $addr->wst_login_id = Auth::id() ;
        $addr->province_cd = $request->post('province') ;
        $addr->province = Area::q_name($addr->province_cd , 'dict_provinces')[0]->name;
        $addr->city_cd = $request->post('city') ;
        $addr->city = Area::q_name($addr->city_cd , 'dict_cities')[0]->name;
        $addr->district_cd = $request->post('district') ;
        $addr->district = Area::q_name($addr->district_cd , 'dict_areas')[0]->name;
        $addr->addr_detail = $request->post('addr_detail') ;
        $addr->save() ;

        return redirect(route('my_address.list')) ;
    }

    public function del($id){
        parent::haveto_login() ;
        $address = ShippingAddress::find($id);
        $address->delete() ;
        return redirect(route('my_address.list')) ;
    }
    public function set_default(Request $request,$id){
        parent::haveto_login() ;


        $rec =  DB::connection()->table('shipping_addresses')->where([
            'wst_login_id'=>Auth::id()
        ])->update(
            [
                'is_default' => 0

            ]
        );


        $address = ShippingAddress::find($id);
        $address->is_default = 1 ;
        $address->save();

        return redirect(route('my_address.list')) ;


    }
}
