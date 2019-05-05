<?php
namespace App\Http\Controllers\Customer;
use App\Biz\Module;
use App\Model\Customer;
use App\My\Helpers;
use App\My\MyAuth;
use App\My\MyStr;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash ;
use App\Http\Controllers\Controller ;
use Illuminate\Support\Facades\Redis ;
use Illuminate\Support\Facades\Session ;
use App\Rules\MobileVcodeCheck ;
use App\Model\WST\YqCompanyUser ;
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





        $user = YqCompanyUser::where('phone',  $data['cellphone'] )->first();



        if(MyAuth::check_company_user(  $data['password'],$user->password))
        {

            session(['cnpy_user' =>$user]);


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
    public function reg()
    {
//        dd(1);
        return view('customer.reg');
    }
    public function reg_store(Request $req)
    {
        $cellphone = $req->post('cellphone') ;
        $vcode = $req->post('vcode') ;

        $data = $this->validate($req,[
            'cellphone'=>'required|regex:/^1[0-9]{10}$/',
            'vcode'=>['required','digits:6',
               new MobileVcodeCheck($cellphone)
            ],
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ])
        ;

        // 存一条 用户

        $customer = Customer() ;
        $customer->cellphone = $data['cellphone'] ;
        $customer->password =  MyAuth::set_pwd($data['password']) ;
        $customer->save() ;


        // 令其登入

        session(['cellphone' =>$data['cellphone']]);

        Auth::login($customer) ;

        // redirect home

        session()->flash(
            'success','登陆成功'
        ) ;
        return redirect(route('customer.home') ) ;


    }
    private function check_vcd($cellphone,$vcode)
    {
        $rest =  Redis::get('mobile.reg:' .$cellphone);

        if ( strcmp($vcode ,$rest) == 0)
        return false ;
        else
        return true ;
    }
}