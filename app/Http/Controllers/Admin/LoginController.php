<?php
namespace App\Http\Controllers\Admin;
use App\Biz\Module;
use App\Model\Admin;
use App\My\Helpers;
use App\My\MyAuth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash ;
use App\Http\Controllers\Controller ;
use Illuminate\Support\Facades\Redis ;
use Illuminate\Support\Facades\Session ;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'only'=>['logout']
        ]);
        $this->middleware('guest',[
            'only'=>['login','store']
        ]);
    }
    public function login()
    {
        return view('admin.login');
    }
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'uname'=>'required',
            'password'=>'required|min:5',
        ]) ;
        $user = Admin::where('uname',  $data['uname'] )->first();

        if(MyAuth::check (  $data['password'],$user->password))
        {

           $menus_modules =  Module::menus_routes($user->id) ;

//dd($menus_modules) ;
           Helpers::p($menus_modules) ;


//            session(['menus_ids' =>$menus_modules[0]]);
//            session(['allow_routes' =>$menus_modules[1]]);
            Auth::login($user) ;

            foreach ($menus_modules[1] as $key=>$item){
                Redis::SADD('allow_routes:'.Auth::id(), $item);
                Redis::EXPIRE('allow_routes:'.Auth::id(), 300);
            }

            foreach ($menus_modules[0] as $key=>$item){
                Redis::SADD('menus_ids:'.Auth::id(), $item);
                Redis::EXPIRE('menus_ids:'.Auth::id(), 300);
            }

            session(['admin' =>[
               'uname'=> $user->uname,
            ]]);




            session()->flash(
                'success','登录成功'
            ) ;
            return redirect('/home' ) ;
        }
        else
        {
            session()->flash(
                'success','登录失败'
            ) ;
            return back() ;
        }
    }
    public function logout()
    {

        Redis::DEL('allow_routes:'.Auth::id()) ;
        Redis::DEL('menus_ids:'.Auth::id()) ;
        Auth::logout() ;
        Session::flush();
        Session::forget('admin') ;

        session()->flash(
            'success','已经退出了'
        ) ;
        return redirect('/login') ;
    }
}