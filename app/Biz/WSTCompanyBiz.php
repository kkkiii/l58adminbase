<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 2019/4/14
 * Time: 17:12
 */

namespace App\Biz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB ;
use App\My\Helpers ;
use App\My\Category ;
use App\Model\Org as OrgModel ;
use App\Model\Customer ;
class WSTCompanyBiz
{

    static public function retrieve_item($cid)
    {
        $sql = <<<EOD
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
yq_company.identity,
yq_company.`status`,
yq_company.add_time,
yq_company.update_time,
yq_company.login_time,
yq_company.orgid,
yq_company.business_img,
yq_company.tax_img,
yq_company.oragan_code_img,
yq_company.logo
FROM
yq_company
WHERE id = $cid
EOD;
        $node = DB::connection('mysql_wst')
            ->select($sql);

        return $node ;

    }

}