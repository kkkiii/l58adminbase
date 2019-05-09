<?php
use Illuminate\Support\Str;
$tot = 0 ;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('order.cart2ord_post') }}" method="POST">
@csrf
@foreach($cart as $item)
    <div class="card">
        <ul class="list-group">
            <li class="list-group-item"> 商品名:{{$item->sy_goods_name}} </li>
            <li class="list-group-item">单价: {{$item->unit_price/100}}</li>
            <li class="list-group-item"> 数量:{{$item->code_amount}}</li>
        </ul>
    </div>
    <?php
    $tot += $item->unit_price * $item->code_amount ;
    ?>
@endforeach



        <div class="card">
           选择地址
            <select name="shipping_address" class="form-control">

                @foreach($addrs as $item )

                    <option  value="{{$item->id}}"
                             @if($item->is_default == 1)
                             selected="selected"
                            @endif

                    >{{$item->addr}}</option>


                @endforeach


            </select>
        </div>

        <div class="card">
            <ul class="list-group">
                <li class="list-group-item"> 合计:{{$tot/100}} </li>
                <button type="submit" class="btn btn-primary">确认</button>
            </ul>
        </div>
    </form>


@endsection