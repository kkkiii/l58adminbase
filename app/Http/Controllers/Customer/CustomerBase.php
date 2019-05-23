<?php
namespace App\Http\Controllers\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller ;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException ;
use App\Model\Customer ;
use Illuminate\Pagination\LengthAwarePaginator ;
class CustomerBase extends Controller
{
    protected function haveto_login()
    {
      if(  is_null(session('cnpy_user')) )
          throw new HttpException(403,'不让访问');

    }
//    protected function dont_use_guest()
//    {
//        if( ! is_null(session('cnpy_user')) )
//            throw new HttpException(403,'不让访问');
//
//    }
    protected function get_bind_company()
    {

       return  session('cnpy_user')->company ;
    }
    protected function get_user()
    {

        return  session('cnpy_user') ;
    }

    public function arrayPaginator($array, $request)
    {

        $page = $request->get('page', 1);
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;

        return new LengthAwarePaginator(array_slice($array, $offset, $perPage, true), count($array), $perPage, $page,
            ['path' => $request->url(), 'query' => $request->query()]);
    }
}
