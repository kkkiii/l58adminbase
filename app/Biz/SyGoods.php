<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/14
 * Time: 17:12
 */

namespace App\Biz;
use Illuminate\Support\Facades\DB ;
use App\My\Helpers ;
use App\My\Category ;
use App\Model\Org as OrgModel ;
class SyGoods
{
    static public function retrive_list($code)
    {

        $products = DB::table('sy_goods')

            ->select( 'sy_goods_id','sy_usc_id', 'sy_cgoods', 'sy_goods_name', 'sy_brand_name')
            ->where(['sy_usc_id'=>$code]) ;

        return  $products ;
    }
    static public function retrive_item($id)
    {
        $product = DB::table('sy_goods')

            ->select( 'sy_goods_id','sy_usc_id', 'sy_cgoods', 'sy_goods_name', 'sy_brand_name' , 'sy_pcate','sy_cate_id')
            ->where(['sy_goods_id'=>$id])->first() ;

        return  $product ;
    }

}