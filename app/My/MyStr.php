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

    public static function gen_random_cd($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i ++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function gen_random_num_cd($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i ++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function gen_random_datenum_cd($length)
    {
        $left =  $length - 10  ;
        $gen_random_str =  static::gen_random_num_cd($left) ;
        return    strrev( $gen_random_str .  time() )  ;
    }


}