<?php
namespace App\Http\Controllers\Admin;
use App\Biz\Module;
use App\My\MyAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException ;
use Illuminate\Support\Facades\Hash ;
use App\My\Helpers ;
class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['home']
        ]);

    }
    public function home(){

//Helpers::p(session('menus_ids')) ;
//        Helpers::p(session('allow_routes')) ;
//
//        Helpers::p(config('app.name') ) ;

//        throw new HttpException(403,'不让访问');

       return view('admin.home') ;
    }
}
