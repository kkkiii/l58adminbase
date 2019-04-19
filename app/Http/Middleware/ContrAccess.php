<?php

namespace App\Http\Middleware;

use App\My\MyStr;
use Closure;
use App\My\Helpers ;
use Illuminate\Session\Middleware\StartSession ;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException ;
use Illuminate\Support\Facades\Redis ;
class ContrAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
//    public function handle($request, Closure $next)
//    {
        //do something
//       $route =  MyStr::purify_admin_url() ;
//
//        Helpers::p( $request->session('menus_ids') )   ;
//
//
//        Helpers::p(session('menus_ids')) ;
//        Helpers::p(session('allow_routes')) ;
        /**
         * RuntimeException
        Session store not set on request.
         * then I will got it from redis
         */

//       dd(session()) ;
//        $allow_arr = session('allow_routes') ;
//        dd($allow_arr) ;

//        if (!in_array($route, $allow_arr))
//         throw new HttpException(403,'不让访问');

//        return $next($request);
//    }


    public function handle($request, Closure $next)
    {
        return app(StartSession::class)->handle($request, function ($request) use ($next) {

            /** @var Response $response */
            $response = $next($request);


            if (Auth::guest())
                return $response;

            $pass_routes =  [
                'logout' , 'home','store'
            ] ;

//            Helpers::p(session('menus_ids')) ;
            $allow_arr  = (session('allow_routes')) ;
            $route =  MyStr::purify_admin_url() ;
            $route2 =  MyStr::purify_url_without_host() ;
//            Helpers::p($allow_arr) ;
//            Helpers::p($route) ;
//            Helpers::p($route2) ;
        if (!in_array($route, $allow_arr)
            &&!in_array($route2, $pass_routes)
        )
         throw new HttpException(403,'不让访问');

            return $response;

        });
    }

}
