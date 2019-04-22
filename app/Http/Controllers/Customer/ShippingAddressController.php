<?php
namespace App\Http\Controllers\Customer;

use App\Model\ShippingAddress;
use App\My\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends CustomerBase
{
    public function list_my(){


       $address = ShippingAddress::where([
            'customer_id'=>Auth::id()
        ])
           ->orderBy('id', 'desc')
           ->get();



        return view('customer.my_address',compact('address')) ;
    }
}
