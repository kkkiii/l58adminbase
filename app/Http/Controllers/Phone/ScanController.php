<?php
namespace App\Http\Controllers\Phone;
use App\Biz\PhoneScan;
//use function Couchbase\defaultDecoder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB ;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Validator ;
use Keiko\Uuid\Shortener\Dictionary;
use Keiko\Uuid\Shortener\Number\BigInt\Converter;
use Keiko\Uuid\Shortener\Shortener;
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
            'p' =>'required|size:22',
        ]);


        if ($validator->fails()) {
                       throw  new HttpException(403) ;
        }

        $shortener = new Shortener(
            Dictionary::createUnmistakable(), // or just pass your own characters set
            new Converter()
        );

        $expand_backUuid = $shortener->expand($p) ;



        $arr = [] ;

        if ($t == '1')
        {


            try {
                $template =    PhoneScan::q1($expand_backUuid);

            } catch (\Exception $e) {
                abort(403) ;
            }

        }

        if( $template)
               return view('phone.scan.q2',[
                    'template'=>$template
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
