<?php
namespace App\Http\Controllers\Customer;
use App\Biz\Module;
use App\Model\Customer;
use App\My\Helpers;
use App\My\MyAuth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash ;
use App\Http\Controllers\Controller ;
use Illuminate\Support\Facades\Redis ;
use Illuminate\Support\Facades\Session ;
class LoginController extends CustomerBase
{
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'only'=>['logout']
//        ]);
//        $this->middleware('guest',[
//            'only'=>['login','store']
//        ]);
//    }
    public function login()
    {
parent::dont_use_guest() ;
        return view('customer.login');
    }
    public function store(Request $request)
    {
        parent::dont_use_guest() ;
        $data = $this->validate($request,[
            'cellphone'=>'required',
            'password'=>'required|min:5',
        ]) ;
        $user = Customer::where('cellphone',  $data['cellphone'] )->first();

        if(MyAuth::check (  $data['password'],$user->password))
        {

            session(['cellphone' =>$user->cellphone]);

            Auth::login($user) ;
            session()->flash(
                'success','登陆成功'
            ) ;
            return redirect(route('customer.home') ) ;
        }
        else
        {
            session()->flash(
                'success','登陆失败'
            ) ;
            return redirect(route('customer.login') ) ;
        }
    }
    public function logout()
    {
        parent::haveto_login() ;
        Session::flush();
        Auth::logout() ;
        session()->flash(
            'success','已经退出了'
        ) ;
        return redirect('/customer/login') ;
    }
}