<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/11
 * Time: 18:55
 */

namespace App\My;
use Illuminate\Support\Facades\URL ;

class MyStr
{
    /**
     * @param $instr to process string
     * @param $delimiter find the last occurrence ,trancate the str tail part left
     *
     */
    public static function str_retrive_left($instr ,$delimiter):string
    {
        $pos = strrpos ($instr,$delimiter) ;
//        $str1 = substr($instr , $pos) ;
        return (  substr($instr , $pos) );
    }

    public static function purify_admin_url():string
    {
        $url = URL::current() ;
        $pos = strrpos ($url,'/admin/') ;
        $str1 = substr($url , $pos +( 8 -1))  ;

        $arr = explode('/' , $str1) ;

        return ( $arr[0] );
    }
    public static function purify_url_without_host():string
    {
        $url = URL::current() ;
        $pos = strrpos ($url,'/') ;
        $str1 = substr($url , $pos )  ;
        $arr = explode('/' , $str1) ;


        return $arr[1];
    }




}