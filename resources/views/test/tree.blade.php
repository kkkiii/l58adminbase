@extends('layouts.master')

@section('style')
    <link rel="stylesheet" type ="text/css" href ="/tree/styles.css" />
    <link rel="stylesheet" type="text/css" href="/tree/dx.common.css" />
    <link rel="dx-theme" data-theme="generic.light" href="/tree/dx.light.css" />
@endsection


@section('content')
    <div class="form">
        <div id="simple-treeview"></div>
        <div id="product-details" class="hidden">
            {{--<img src="" />--}}
            <div class="name"></div>
            {{--<div class="price"></div>--}}
        </div>
    </div>
@endsection


@section('js')
    <script src="/tree/dx.all.js"></script>
    {{--<script src="/tree/data2.js"></script>--}}
    <script>
        var products =
       <?php
        echo json_encode($res)  ;
        ?> ;
    </script>


    <script src="/tree/index.js"></script>
@endsection