<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/9
 * Time: 11:10
 */
namespace App\My;
class Helpers
{
    public static function re_sort_arr_key($array)
    {
        if (empty($array)) {
            return $array;
        }
        while ($value = current($array)) {
            $arr[] = $value;
            next($array);
        }
        return ($arr);
    }
    public static function p($data){
        // 定义样式
        $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
        // 如果是boolean或者null直接显示文字；否则print
        if (is_bool($data)) {
            $show_data=$data ? 'true' : 'false';
        }elseif (is_null($data)) {
            $show_data='null';
        }else{
            $show_data=print_r($data,true);
        }
        $str.=$show_data;
        $str.='</pre>';
        echo $str;
    }
    public static function future_time_point($ttype,$tspan,$kickoff_at)
    {
        $date1 = date('Y-m-d',$kickoff_at) ;
        $target_date = null ;
        switch ($ttype) {
            case 1: // 86400); //60s*60min*24h
                $target_date =   date('Y-m-d',strtotime("$date1 +$tspan day"));
                break;
            case 2:// 86400); //60s*60min*24h*7
                $target_date =   date('Y-m-d',strtotime("$date1 +$tspan*7 day"));
                break;
            case 3:
                $target_date =   date('Y-m-d',strtotime("$date1 +$tspan month"));
                break;
            default:
                ;
                break;
        }
        return $target_date ;
    }
    public static function future_time_point_unixtime($ttype,$tspan,$kickoff_at)
    {
        $date1 = date('Y-m-d',$kickoff_at) ;
        $target_date = null ;
        switch ($ttype) {
            case 1: // 86400); //60s*60min*24h
                $target_date =  strtotime("$date1 +$tspan day");
                break;
            case 2:// 86400); //60s*60min*24h*7
                $target_date =  strtotime("$date1 +$tspan*7 day");
                break;
            case 3:
                $target_date =   strtotime("$date1 +$tspan month");
                break;
            default:
                ;
                break;
        }
        return $target_date ;
    }
    public static function deposit_time_progress($ttype,$tspan,$kickoff_at,$now_time)
    {
        $target_date = self::future_time_point_unixtime($ttype, $tspan, $kickoff_at) ;
        if (($now_time >= $kickoff_at) && ($target_date >= $kickoff_at))
        {
            $progress   = ($now_time - $kickoff_at ) / ($target_date - $kickoff_at) ;
            return $progress ;
        }
        else
            return -1 ;
    }
    //天数之间相减
    public static function timeDays($startTime,$endTime)
    {
        $startTimeDay = strtotime(date('Y-m-d',$startTime));
        $endTimeDay = strtotime(date('Y-m-d',$endTime));
        $days=ceil(($endTimeDay-$startTimeDay)/86400); //60s*60min*24h
        if($days < 0) $days = 0;
        return $days;
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
    public static function isMobile() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])){
            return true;
        }
        //如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            //找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        //判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array (
                'nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        //协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }
    public static function gen_14digit_sn() {
        return $order_id =  date('Ymd') . str_pad(mt_rand(1, 999999), 5, '0', STR_PAD_LEFT);
    }
    public static function build_rest_res($cd ,$data =[],$msg='成功') {
        if ($cd == 1)
            return [
                "code" => $cd ,
                "data"=> $data,
                "msg"=> RtnCodeMap::coresponding_msg($cd)
            ] ;
        else
        {
            return [
                "code" => $cd ,
                "data"=>[],
                "msg"=> RtnCodeMap::coresponding_msg($cd)
            ] ;
        }
    }
    public static function getTree($array, $pid =0, $level = 0){
        //声明静态数组,避免递归调用时,多次声明导致数组覆盖
        static $list = [];
        foreach ($array as $key => $value){
            //第一次遍历,找到父节点为根节点的节点 也就是pid=0的节点
            if ($value['pid'] == $pid){
                //父节点为根节点的节点,级别为0，也就是第一级
                $value['level'] = $level;
                //把数组放到list中
                $list[] = $value;
                //把这个节点从数组中移除,减少后续递归消耗
                unset($array[$key]);
                //开始递归,查找父ID为该节点ID的节点,级别则为原级别+1
                static::getTree($array, $value['id'], $level+1);
            }
        }
        return $list;
    }
    public static  function objectToArray($object) {
        //先编码成json字符串，再解码成数组
        return json_decode(json_encode($object), true);
    }
    public static  function merge_arr($arr) {
        $collection = collect($arr);
        $collection2 =   $collection->filter(function($value, $key) {
            return  $value != null;
        });
        return ($collection2->toArray()) ;
    }


}