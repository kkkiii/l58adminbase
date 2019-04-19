<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\My\MyStr ;
use App\My\Helpers ;
use Symfony\Component\HttpKernel\Exception\HttpException ;
class AdminBase extends Controller
{
    protected function check_module()
    {
        $allow_arr  = (session('allow_routes')) ;
        $route =  MyStr::purify_admin_url() ;
/*//
        Helpers::p($allow_arr) ;
        Helpers::p($route) ;
//*/
        if (!in_array($route,$allow_arr))
            throw new HttpException(403,'不让访问');

    }

}
