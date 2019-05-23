<?php

namespace App\Http\Controllers\Phone;

use App\Biz\PhoneScan;
use App\Biz\TemplateBiz;
use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB ;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Validator ;
class PreViewController extends Controller
{
    public function q($p)
    {


        $template = TemplateBiz::qitem($p) ;


        if ($p)
        {
            return view('phone.scan.pre',[
                'template'=>$template
            ]) ;
        }
            else

                abort(403) ;


    }



//    public function render($request, Exception $e) {
//        dump(4) ;
//        if($e instanceof ValidationException) {
//           throw new HttpException(403) ;
//        }
//    }
}
