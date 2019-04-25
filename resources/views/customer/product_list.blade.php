<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <a href="{{route('product.create')}}" class="btn btn-primary">增加</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">产品名</th>

            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($products as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->pname}}</td>



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