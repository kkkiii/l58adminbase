<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB ;
use App\My\ResBuilder ;
use App\My\MyStr;
use Illuminate\Support\Facades\Redis ;
class MobileVcodeController extends Controller
{


    public function get2reg(Request $req) {
        $mobile = $req->post('pno') ;

        $rstr = MyStr::gen_random_num_cd(6) ;
        $rest =  Redis::set('mobile.reg:' . $mobile,$rstr);
        $rest =  Redis::expire('mobile.reg:' . $mobile,180);

        return ResBuilder::rtn_json([]);

    }
}
