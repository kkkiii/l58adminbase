<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/1
 * Time: 17:18
 */

namespace App\My;
use App\My\Helpers ;
use App\My\MyConstant ;
class MyAuth
{

    public static function check($plain ,$pwd_hash)
    {
        $authcode = env('APP_AUTHCODE') ;

        return  "###" . md5(md5( $authcode . $plain))  == $pwd_hash;
    }
    public static function set_pwd($plain ):string
    {
        $authcode = env('APP_AUTHCODE') ;
     return   "###" . md5(md5( $authcode . $plain)) ;
    }


    public static function check_company_user($plain ,$pwd_hash)
    {
        $authcode = MyConstant::$APP_CPNY_AUTHCODE ;

        return   md5(sha1( $plain) . $authcode)== $pwd_hash ;

    }
    public static function set_company_user_pwd($plain ):string
    {
        $authcode = MyConstant::$APP_CPNY_AUTHCODE ;
        return   md5(sha1( $plain) . $authcode) ;
    }

    public static function can_access (){
        $allow_arr  = (session('allow_routes')) ;
        $route =  MyStr::purify_admin_url() ;
        $route2 =  MyStr::purify_url_without_host() ;
//            Helpers::p($allow_arr) ;
//            Helpers::p($route) ;
//            Helpers::p($route2) ;
        if (!in_array($route, $allow_arr)
//            &&!in_array($route2, $pass_routes)
        )
            throw new HttpException(403,'不让访问');
    }

}