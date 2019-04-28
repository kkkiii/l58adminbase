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
DISTINCT big_category
FROM
farm_products
EOD;
        $res = DB::connection()
            ->select($sql);
        return   $res;

    }
    static public function cat1_cate2($cate1)
    {
        $sql = <<<EOD
SELECT 
id,
small_category
FROM
farm_products
WHERE
big_category = '$cate1'
EOD;
        $res = DB::connection()
            ->select($sql);
        return   $res;
    }

}