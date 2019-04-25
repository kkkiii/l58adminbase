<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <p><code class="highlighter-rouge">产品</code></p>

            </td>
            <td><span class="h1">{{$product->pname}}</span></td>
        </tr>

        <tr>
            <td>
                <p><code class="highlighter-rouge">单价</code></p>

            </td>
            <td><span class="h1">{{$product_price->unit_price / 100}}</span></td>
        </tr>

        <tr>
            <td>
                <p><code class="highlighter-rouge">订购数量</code></p>

            </td>
            <td><span class="h1">{{$ord_amt}}</span></td>
        </tr>


        <tr>
            <td>
                <p><code class="highlighter-rouge">合计</code></p>

            </td>
            <td><span class="h1">{{$ord_amt * $product_price->unit_price / 100}}</span></td>
        </tr>

        </tbody>
    </table>

    <a href="javascript:history.go(-1);" class="btn btn-primary">返回</a>

    <form action="{{ route('order.create_post') }}" method="POST">
        @csrf

        <input type="hidden" name="product_id" value="{{$product->id}}">
        <input type="hidden" name="code_amount" value="{{$ord_amt}}">
        <input type="hidden" name="code_type" value="{{$product_price->id}}">
        <input type="hidden" name="unit_price" value="{{$product_price->unit_price}}">




        <div class="form-group">
            <label>选择地址</label>
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




        <button class="btn btn-primary" type="submit">确认</button>
    </form>

@endsection

@section('js')
    {{--<script src="{{ asset('js/custom.js') }}"></script>--}}
@endsection