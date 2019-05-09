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
use PDO ;
class Cart
{
   /* static public function build_tree($data)
    {
        $sql = <<<EOD
SELECT
orgs.id,
orgs.org_name text,
orgs.parentid,
orgs.province_id,
orgs.province,
orgs.city_id,
orgs.city,
orgs.district_id,
orgs.district,
orgs.sort
FROM
orgs
ORDER BY sort 

EOD;
        $tree_nodes = DB::connection()
            ->select($sql);

        $arr = Helpers::objectToArray($tree_nodes) ;
        $res =  Category::unlimitedForlayer($arr,'items') ;

        return $res ;
    }*/
    static public function header_show_count($uid)
    {
        $sql = <<<EOD
SELECT
COUNT(1) cnt
FROM
cart
WHERE
cart.uid = $uid
EOD;
        $res =  DB::connection()
            ->select($sql);

        if(isset($res))
            return $res[0]->cnt ;
        else
            return null ;

    }
    static public function push2cart($data)
    {

    $goods_id =     $data['sy_goods_id'] ;
    $dict_2_code =  $data['dict_2_code'];
    $uid = $data['uid'];

//        1 check exists

        $sql = <<<EOD
SELECT
1
FROM
cart
WHERE
cart.uid = $uid
AND cart.sy_goods_id = $goods_id
EOD;
        $res =  DB::connection()
            ->select($sql);



        if (empty($res))

        {
            // insert

            $cart = new \App\Model\Cart() ;
            $cart->uid = $uid ;
            $cart->sy_goods_id = $goods_id ;

            $cart->dict_2_code = $dict_2_code ;
            $cart->sy_goods_name = $data['sy_goods_name'] ;
            $cart->unit_price = $data['unit_price'] ;
            $cart->code_amount = $data['code_amount'] ;
            $cart->save() ;

        }else
        {
            //update unit_price and increase amount

            DB::table('cart')
                ->where([
                    'uid'=>$uid ,
                    'sy_goods_id'=>$goods_id ,
                ])
                ->increment('code_amount', intval( $data['code_amount'] )) ;


        }


    }

    static public function retrive2checkout($uid)
    {

        $sql = <<<EOD
SELECT
cart.uid,
cart.sy_goods_id,
cart.sy_goods_name,
cart.unit_price,
cart.code_amount
FROM
cart
WHERE
cart.uid = $uid
EOD;
        $res =  DB::connection()
            ->select($sql);



        if(isset($res))
            return $res ;
        else
            return null ;
    }
    static public function sum_tot($uid)
    {
        $sql = <<<EOD
SELECT
SUM(unit_price*code_amount) tot
FROM
cart
WHERE
cart.uid = $uid
EOD;
        $res =  DB::connection()
            ->select($sql);

        if(isset($res))
            return $res ;
        else
            return null ;
    }

}