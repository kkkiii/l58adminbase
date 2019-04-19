<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class OrderController extends Controller
{
    public function list(){

        return view('customer.order_list') ;
    }
}
