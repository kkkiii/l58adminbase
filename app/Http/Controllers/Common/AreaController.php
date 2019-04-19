<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB ;
class AreaController extends Controller
{
    public function getCities($id) {


        $sql = <<<EOD
SELECT
dict_cities.`code`,
dict_cities.`name`
FROM
dict_cities
WHERE 
left(dict_cities.`code`, 2) = '$id'
EOD;
        $cities = DB::connection()
            ->select($sql);


        if (count($cities) ==1)
        {
            $cities = array_merge(
                [[
                    'code'=>$cities[0]->code,'name'=>'直辖市'
                ]]
                ,$cities
            ) ;
        }else
            $cities = array_merge(
                [[
                    'code'=>$cities[0]->code,'name'=>'选择市'
                ]]
                ,$cities
            ) ;


        return json_encode($cities);

    }

    public function getDistrict($id) {


        $sql = <<<EOD
SELECT
dict_areas.`code`,
dict_areas.`name`
FROM
dict_areas
WHERE 
left(dict_areas.`code`, 4) = '$id'
EOD;
        $districts = DB::connection()
            ->select($sql);


        return json_encode($districts);

    }
}
