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
class Org
{
    static public function build_tree()
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
    }
    static public function retrive_item($id)
    {
      return   OrgModel::find($id) ;
    }

}