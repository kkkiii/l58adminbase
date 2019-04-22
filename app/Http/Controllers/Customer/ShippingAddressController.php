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
            'customer_id'=>Auth::id()
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
                'customer_id'=>$uid
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
    public function del($id){
        parent::haveto_login() ;
        $address = ShippingAddress::find($id);
        $address->delete() ;
        return redirect(route('my_address.list')) ;
    }
    public function set_default(Request $request,$id){
        parent::haveto_login() ;


        $rec =  DB::connection()->table('shipping_addresses')->where([
            'customer_id'=>Auth::id()
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
