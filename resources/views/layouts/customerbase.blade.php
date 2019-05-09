<?php
use App\Biz\Cart ;
 $uid = session('cnpy_user')->id ? session('cnpy_user')->id : 0;
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield('style')
</head>
<body>
<nav id="navbar-example2" class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
        @if( $uid = \Illuminate\Support\Facades\Auth::id())
            {{session('cnpy_user')->company->company_name}}
        @else
            公司
        @endif

    </a>
    <ul class="nav nav-pills">


        @if($uid && $cnt = Cart::header_show_count($uid))
            <li class="nav-item">
                <a class="nav-link" href="{{route('order.cart2ord')}}">结算({{$cnt}})</a>
            </li>
            @endif


        <li class="nav-item">
            <a class="nav-link" href="{{route('enterprise.index')}}">企业资料</a>
        </li>


        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">商品资料</a>
            <div class="dropdown-menu">

                <a class="dropdown-item" href="{{route('product.list')}}">列表</a>
                <a class="dropdown-item" href="{{route('product.create')}}">创建</a>
            </div>
        </li>



        <li class="nav-item">
            <a class="nav-link"href="{{route('order.list')}}">订单</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{session('cnpy_user')->realname}}</a>
            <div class="dropdown-menu">

                <a class="dropdown-item" href="{{route('my_address.list')}}">我的收货地址</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{url('/customer/logout')}}">登出</a>
            </div>
        </li>
    </ul>
</nav>




<div class="container-fluid">






        <main role="main" class="">

            @include('layouts.errors')
            @include('layouts.msg')



            @yield('content')

        </main>



</div>


<!-- JavaScript files-->
<script src="/js/app.js"></script>
@yield('js')
</body>
</html>