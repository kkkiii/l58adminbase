<?php
namespace App\Http\Controllers\Phone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Keiko\Uuid\Shortener\Dictionary;
use Keiko\Uuid\Shortener\Number\BigInt\Converter;
use Keiko\Uuid\Shortener\Shortener;
class TestController extends Controller
{
    public function shorten(Request $request,$code)
    {
        $shortener = new Shortener(
            Dictionary::createUnmistakable(), // or just pass your own characters set
            new Converter()
        );
        $shortUuid = $shortener->reduce($code) ;
        $expand_backUuid = $shortener->expand($shortUuid) ;
        dump($shortUuid );
        dump($expand_backUuid );
//        echo $shortener->expand($shortUuid);


    }
}
