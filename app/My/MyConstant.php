<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/1
 * Time: 17:18
 */

namespace App\My;


class MyConstant {
    public static $APP_CPNY_AUTHCODE = '`1L9T)sC<$V*>Op4."jyfvt%XqWc0M#FnhoiP]Id' ;
public static  $amqp_cluster =
        [
            ['host' => "172.16.16.130", 'port' => 30000, 'user' => 'guest', 'password' =>  'guest'],
            ['host' => "172.16.16.130", 'port' => 30002, 'user' => 'guest', 'password' =>  'guest'],
            ['host' => "172.16.16.130", 'port' => 30004, 'user' => 'guest', 'password' =>  'guest'],
        ] ;
}