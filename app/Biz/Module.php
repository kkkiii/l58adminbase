<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/14
 * Time: 17:12
 */

namespace App\Biz;
use Illuminate\Support\Facades\DB ;

class Module
{
    static public function menus_routes($uid)
    {
        $modules =collect (DB::select("SELECT * from v_admin_id2modules where admin_id = $uid"));


        $menus_array  = $modules->pluck('menus')->map(function ($item, $key) {
            return json_decode($item);
        })->flatten ()->all();

        $routes_array  = $modules->pluck('routes')->map(function ($item, $key) {
            return json_decode($item);
        })->flatten ()->all();


        return [$menus_array,$routes_array] ;


    }

}