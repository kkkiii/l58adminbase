<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')


    <a class="btn btn-primary"  href="{{route('product.create')}}" role="button">创建</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">类别</th>
            <th scope="col">商品名称</th>

            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($products as $item)

            <tr>
                <th scope="row">{{$item->sy_goods_id}}</th>
                <td>
                    {{$item->sy_cgoods}}
               </td>
                <td>
                    {{$item->sy_goods_name}}
                </td>



                <td>
                    <a href="/customer/product.edit/{{$item->sy_goods_id}}" class="btn btn-info">编辑</a>
                    <a href="/customer/product.del/{{$item->sy_goods_id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">删除</a>
                    <a href="/customer/order.create/{{$item->sy_goods_id}}" class="btn btn-info">申请码标</a>
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>

    {{ $products->links()}}

@endsection