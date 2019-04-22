<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CodeLableController extends CustomerBase
{
    public function apply($pid){
        parent::haveto_login() ;
        dd($pid) ;
        return view('customer.order_list') ;
    }
}
