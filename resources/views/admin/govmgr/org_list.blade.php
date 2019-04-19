<?php
use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')
@section('style')
    <link rel="stylesheet" type ="text/css" href ="/tree/styles.css" />
    <link rel="stylesheet" type="text/css" href="/tree/dx.common.css" />
    <link rel="dx-theme" data-theme="generic.light" href="/tree/dx.light.css" />
@endsection
@section('content')
    {{--<form action="/admin/govmgr.org_list_post" method="post">--}}
        @csrf
    <div class="form">
        <div id="simple-treeview"></div>
        <div id="product-details" class="hidden">
            <div class="name"></div>
            {{--<input type="hidden" value="" name="orgid">--}}
            {{--<button class="btn btn-info" data-toggle="modal" data-target="#logoutModal" >删除</button>--}}

            <a href="#" id="btn_del" class="btn btn-info">删除</a>
            <a href="#" id="btn_edit"  class="btn btn-info">修改</a>
            <a href="#" id="btn_sub"  class="btn btn-info">增加子组织</a>
            {{--<a href="#" id="btn_root"  class="btn btn-warning">增加跟组织</a>--}}
        </div>
    </div>

    {{--</form>--}}

    <a href="/admin/govmgr.org_list_root" id="btn_root"  class="btn btn-warning">增加跟组织</a>


@endsection
@section('js')
    <script src="/tree/dx.all.js"></script>
    <script>
        var products =
            <?php
            echo json_encode($res)  ;
            ?> ;
    </script>
    <script src="/tree/index.js"></script>
@endsection