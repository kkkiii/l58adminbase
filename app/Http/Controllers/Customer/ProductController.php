<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ProductController extends CustomerBase
{
    public function list(){
        parent::haveto_login() ;
        return view('customer.product_list') ;
    }
}
