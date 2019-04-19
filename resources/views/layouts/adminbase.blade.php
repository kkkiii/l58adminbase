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


<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{session('uname')}}</a>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{url('/logout')}}">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">


        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">


               @include('layouts.sidermenu')


            </div>
        </nav>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

            @include('layouts.errors')
            @include('layouts.msg')



            @yield('content')

        </main>


    </div>
</div>


<!-- JavaScript files-->
<script src="/js/app.js"></script>
@yield('js')
</body>
</html>