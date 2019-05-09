<?php

namespace App\Http\Controllers\Phone;

use App\Biz\PhoneScan;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB ;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Validator ;
class ScanController extends Controller
{
    public function q(Request $request)
    {
        $t=  ($request->query('t')) ;
        $p =($request->query('p')) ;



//        $data = $request->validate($request,[
//            't'=>'required|integer|size:1',
//            'p'=>'required|size:36',
//        ]) ;


        $validator = Validator::make($request->all(), [
            't' =>'required|integer|size:1',
            'p' =>'required|size:36',
        ]);

        if ($validator->fails()) {
            throw  new HttpException(403) ;
        }

        $arr = [] ;

        if ($t == '1')
        {


            try {
                $arr =    PhoneScan::q1($p);
            } catch (\Exception $e) {
                abort(403) ;
            }

        }

        if( !empty($arr))
               return view('phone.scan.q',[
                    'company'=>$arr[0],
                    'product'=>$arr[1]
                ]) ;
        else
            abort(403) ;


//            if (!is_null($res2[0]) && !is_null($res[0]))
//                return view('phone.scan.q',[
//                    'company'=>$res2[0],
//                    'product'=>$res[0]
//                ]) ;
//            else
//                throw new HttpException(403) ;









    }



    public function render($request, Exception $e) {
        dump(4) ;
        if($e instanceof ValidationException) {
           throw new HttpException(403) ;
        }
    }
}
