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

            ->select(
                'sy_goods_id',
                'sy_pcate',
                'sy_cate_id',
                'sy_cgoods',
                'sy_usc_id',
                'sy_goods_name',
                'sy_brand_name',
                'sy_goods_sn',
                'sy_package_unit',
                'sy_goods_number',
                'sy_uom',
                'sy_production_date',
                'sy_shelf_life',
                'sy_uo_shelf_life',
                'sy_appearance_goods_url',
                'sy_apthumbnail_url',
                'sy_label_picture_url',
                'sy_label_thumbnail_url',
                'sy_goods_bases',
                'sy_goods_desc',
                'sy_lot',
                'sy_origin_cd',
                'sy_origin_title',
                'sy_goods_level',
                'updated_at',
                'created_at'
            )
            ->where(['sy_goods_id'=>$id])->first() ;

        return  $product ;
    }

}