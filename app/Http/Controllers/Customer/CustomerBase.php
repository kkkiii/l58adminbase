<?php
namespace App\Http\Controllers\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller ;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException ;
use App\Model\Customer ;
class CustomerBase extends Controller
{
    protected function haveto_login()
    {
      if(  is_null(session('cnpy_user')) )
          throw new HttpException(403,'不让访问');

    }
    protected function dont_use_guest()
    {
        if( ! is_null(session('cnpy_user')) )
            throw new HttpException(403,'不让访问');

    }
    protected function get_bind_company()
    {

       return  session('cnpy_user')->company ;
    }

}
