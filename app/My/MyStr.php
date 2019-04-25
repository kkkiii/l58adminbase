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
    //生成24位唯一订单号
    public static function create_orderid(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    /**
     * php 生成唯一id
     *
     */
    function guid($factor='',$prefix='',$suffix=''){
        list($usec, $sec) = explode(" ", microtime());
        $guid = $prefix. $factor. $_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']
            . $sec . $usec
            . mt_rand(0,1000000).time(). mt_rand(0,1000000).$suffix;
        $guid = substr(sha1($guid),8,32);
        $guid = base_convert($guid,16,36);
        return $prefix.$guid.$suffix;
    }


//生成唯一标识符   //sha1()函数， "安全散列算法（SHA1）"
    function create_unique(){
        $data = $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].time().rand();
        return sha1($data);//return md5(time().$data);   //return $data;
    }

}