<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class EnterpriseController extends Controller
{
    public function index(){

        return view('customer.enterprise_index') ;
    }
}
