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
use Illuminate\Support\Arr;
class FarmProductBiz
{
    static public function cat1_list()
    {
        $sql = <<<EOD
SELECT
dict_first_prod.`code`,
dict_first_prod.farm_products_first title
FROM
dict_first_prod
EOD;
        $res = DB::connection()
            ->select($sql);
        return   $res;

    }
    static public function cat1_cate2($cate1)
    {
        $sql = <<<EOD
SELECT
dict_second_prod.`code`,
dict_second_prod.farm_products_second title
FROM
dict_second_prod
WHERE
pcode = $cate1
EOD;
        $res = DB::connection()
            ->select($sql);
        return   $res;
    }

    static public function trans_cate2_name($cate2)
    {
        $sql = <<<EOD
SELECT
dict_second_prod.`code`,
dict_second_prod.pcode,
dict_second_prod.farm_products_second title,
dict_second_prod.goods_name,
dict_second_prod.unit_price,
dict_second_prod.comments
FROM
dict_second_prod
WHERE
dict_second_prod.`code` =  $cate2
EOD;
        $res = DB::connection()
            ->select($sql);
        return   $res;
    }

}