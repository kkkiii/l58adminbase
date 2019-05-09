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
class PhoneScan
{

    static public function q1($p)
    {
// retrieve code
        $sql = <<<EOD
SELECT
code1.sn,
code1.wst_company_id,
code1.goods_id,
code1.ord_detail_id,
code1.scan_1st,
code1.total_scan,
code1.created_at,
code1.updated_at
FROM
code1
WHERE sn = '$p'
EOD;
        $node = DB::connection()
            ->select($sql);

        $arr = Helpers::objectToArray($node) ;


        $company_id =0;
        $goods_id =0;
if ($arr)
    $company_id =data_get($arr, '*.wst_company_id');

        if ($arr)
            $goods_id =data_get($arr, '*.goods_id');

//dump($goods_id[0]) ;
//        dump($company_id[0]) ;



// 公司数据

        $company = WSTCompanyBiz::retrieve_item($company_id[0]) ;
        //商品数据

        $goods= SyGoods::retrive_item($goods_id[0]) ;

            return  [$company[0] , $goods];
    }

}