<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">类别</th>
            <th scope="col">规格</th>

            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($products as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>
                    @if ($item->cate2)
                          {{   FarmProduct::find($item->cate2)->big_category .   FarmProduct::find($item->cate2)->small_category   }}
                    @endif
               </td>
                <td>{{$item->variety}}</td>



                <td>
                    <a href="/customer/product.edit/{{$item->id}}" class="btn btn-info">编辑</a>
                    <a href="/customer/product.del/{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">删除</a>
                    <a href="/customer/order.create/{{$item->id}}" class="btn btn-info">申请码标</a>
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>

    {{ $products->links()}}

@endsection