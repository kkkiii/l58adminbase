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
class Area
{
    static public function q_name($id,$table_name)
    {
        $sql = <<<EOD
SELECT
`code`,
`name`
FROM
$table_name
WHERE
`code` = $id
EOD;
        $res = DB::connection()
            ->select($sql);

        return $res ;
    }
    static public function retrive_item($id)
    {
      return   OrgModel::find($id) ;
    }

}