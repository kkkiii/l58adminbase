<?php

namespace App\Http\Controllers\Phone;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB ;
class ScanController extends Controller
{
    public function q(Request $request)
    {
        $t=  ($request->query('t')) ;
        $p =($request->query('p')) ;



        $data = $this->validate($request,[
            't'=>'required|integer|size:1',
            'p'=>'required|size:36',
        ]) ;




        $sql = <<<EOD
SELECT
code1.wst_company_id,
code1.company_id,
code1.product_id,
code1.sn,
farm_products.big_category,
farm_products.goods_category,
products.variety
FROM
code$t
INNER JOIN products ON code1.product_id = products.id
INNER JOIN farm_products ON products.cate2 = farm_products.id
WHERE 
sn = '$p'
EOD;
        $res = DB::connection()
            ->select($sql);

//        dump($res[0]) ;
        $wst_company_id = $res[0]->wst_company_id ;


        $sql2 = <<<EOD
SELECT
yq_company.id,
yq_company.company_name,
yq_company.company_code,
yq_company.company_property,
yq_company.province_id,
yq_company.province,
yq_company.city_id,
yq_company.city,
yq_company.district_id,
yq_company.district,
yq_company.addr,
yq_company.legal_person,
yq_company.indusiry_involved,
yq_company.company_profile,
yq_company.`name`,
yq_company.phone,
yq_company.telephone,
yq_company.id_number,
yq_company.user_email,
yq_company.postal_code,
yq_company.business_number,
yq_company.tax_id,
yq_company.user_addr,
yq_company.oraganizing_code,
yq_company.identity
FROM
yq_company
where
id = $wst_company_id
EOD;
        $res2 = DB::connection('mysql_wst')
            ->select($sql2);


//        dump($res2[0]);

        return view('phone.scan.q',[
            'company'=>$res2[0],
            'product'=>$res[0]
        ]) ;
    }
}
