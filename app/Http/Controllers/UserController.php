<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;
class UserController extends Controller
{
    //
    public function login(){
        $username = request()->get('username');
        $password = request()->get('password');

        //验证账号密码，postdata数据key为数据库存储字段名。
        $postdata = ['user_name' => $username, 'user_pass'=>$password];
        $ret = Auth::attempt($postdata);
        if($ret){
            return 'success';
        }
        return $username.$password;
    }
}
