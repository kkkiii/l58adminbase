<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\My\MyStr ;
use App\My\Helpers ;
use Symfony\Component\HttpKernel\Exception\HttpException ;
use Illuminate\Support\Facades\Redis ;
use Illuminate\Support\Facades\Auth ;
class AdminBase extends Controller
{


    protected function check_module()
    {
        $allow_arr  = Redis::SMEMBERS('allow_routes:'.Auth::id()) ;

        Redis::EXPIRE('menus_ids:'.Auth::id(), 300);
        Redis::EXPIRE('allow_routes:'.Auth::id(), 300);

        $route =  MyStr::purify_admin_url() ;
/*
        Helpers::p($allow_arr) ;
//*/

       if (is_null($allow_arr))
           abort(403,"重新登录");



    }

}
