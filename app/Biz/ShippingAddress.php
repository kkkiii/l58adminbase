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
class ShippingAddress
{
    static public function addr_options($uid)
    {
        $sql = <<<EOD
SELECT
	shipping_addresses.id,
	concat(
		shipping_addresses.province,
		shipping_addresses.city,
		shipping_addresses.district,
		shipping_addresses.addr_detail
	) addr,
	shipping_addresses.is_default
FROM
	shipping_addresses
WHERE
	wst_login_id = $uid
EOD;
        $res = DB::connection()
            ->select($sql);

        return $res ;
    }


}