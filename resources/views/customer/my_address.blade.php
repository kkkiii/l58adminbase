<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    {{--<link rel="stylesheet" href="/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">--}}
    @endsection


@section('content')

    <a href="{{route('product.create')}}" class="btn btn-primary">增加</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">省市区</th>
            <th scope="col">详细</th>
            <th scope="col">是否缺省</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($address as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->province .$item->city . $item->district }}</td>
                <td>{{$item->addr_detail}}</td>
                <td>
                    @if($item->is_default == 1)
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                    @endif

                        <i class="fas fa-user-check"></i>

                </td>



                <td>
                    <a href="/customer/product.edit/{{$item->id}}" class="btn btn-info">编辑</a>
                    <a href="/customer/product.del/{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">删除</a>
                    <a href="/customer/code_lable.apply/{{$item->id}}" class="btn btn-info">申请码标</a>
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>



@endsection