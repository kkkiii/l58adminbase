<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class OrderController extends CustomerBase
{
    public function list(){
        parent::haveto_login() ;
        return view('customer.order_list') ;
    }
}
