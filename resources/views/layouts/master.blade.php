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

<div class="container">


    @include('layouts.errors')
    @include('layouts.msg')
    @yield('content')


</div>


<script src="/js/app.js"></script>
@yield('js')
</body>
</html>