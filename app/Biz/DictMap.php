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
class DictMap
{
    static public function q_ent_type($code)
    {
        $sql = <<<EOD
SELECT
dict_reg_ent_type.cd,
dict_reg_ent_type.reg_type
FROM
dict_reg_ent_type
WHERE
cd = $code
EOD;
        $res = DB::connection()
            ->select($sql);

        return $res[0] ;
    }

}