<?php

namespace App\Http\Controllers\Common;

use App\Biz\FarmProductBiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB ;
class FarmProdCateController extends Controller
{

    public function getCate2($cate1) {
      $cate2 =  FarmProductBiz::cat1_cate2($cate1) ;
        return json_encode($cate2);
    }
}
