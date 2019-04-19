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


            session(['menus_ids' =>$menus_modules[0]]);
            session(['allow_routes' =>$menus_modules[1]]);


            foreach ($menus_modules[1] as $key=>$item){
                Redis::lpush('allow_routes:'.Auth::id(), $item);
            }

            foreach ($menus_modules[0] as $key=>$item){
                Redis::lpush('menus_ids:'.Auth::id(), $item);
            }

            session(['uname' =>$user->uname]);

            Auth::login($user) ;
            session()->flash(
                'success','登陆成功'
            ) ;
            return redirect('/home' ) ;
        }
        else
        {
            session()->flash(
                'success','登陆失败'
            ) ;
            return back() ;
        }
    }
    public function logout()
    {
        Auth::logout() ;
        session()->flash(
            'success','已经退出了'
        ) ;
        return redirect('/login') ;
    }
}