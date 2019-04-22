<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/11
 * Time: 18:55
 */

namespace App\My;
use Illuminate\Support\Facades\URL ;

class ResBuilder
{
    /**
     * @param $instr to process string
     * @param $delimiter find the last occurrence ,trancate the str tail part left
     *
     */
    public static function rtn_json($in_arr,$cd=1 ,$msg='Success' ):string
    {

        $rtn= [
            'cd'=>$cd ,
        'msg'=>$msg,
            'data'=>$in_arr
            ] ;

        if ($cd==-1)
            $rtn['msg']='Fail' ;

        return json_encode($rtn);
    }




}