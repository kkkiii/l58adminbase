<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">创建日期</th>
            <th scope="col">数量</th>
            <th scope="col">单价</th>
            <th scope="col">合计</th>
            <th scope="col">阶段</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($orders as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->created_at}}</td>

                <td>{{$item->code_amount}}</td>
                <td>{{$item->unit_price/100}}</td>
                <td>{{$item->tot_money/100}}</td>
                <td>{{$item->flowstop->title}}</td>
                <td>

                    @if($item->flow_stop == 0)
                    <a href="/customer/order.del/{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">删除</a>
                    <a href="/customer/order.pay/{{$item->id}}" class="btn btn-info">付钱</a>
                    @endif

                </td>
            </tr>

        @endforeach



        </tbody>
    </table>

    {{ $orders->links()}}

@endsection