<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <div class="card">

        <div class="card-body">
            <h5 class="card-title">选择支付方式</h5>
            <p class="card-text">应付:{{$ord->tot_money/100}}</p>

        </div>
    </div>


<form action="{{route('pay.choose_post')}}" method="post">
@csrf

    <div class="row">
        <input type="hidden" value="{{$ord->our_sn}}" name="ordsn">
        <input type="hidden" value="{{$ord->tot_money}}" name="tot_amount">
        <div class="col-sm">
            <div class="card">

                <div class="card-body">

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="channel" id="exampleRadios1" value="alipay" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            支付宝
                            <img src="/pics/alipay.jpg" class="rounded float-left" alt="...">
                        </label>
                    </div>


                </div>
            </div>
        </div>
        {{--<div class="col-sm">--}}
            {{--<div class="card">--}}

                {{--<div class="card-body">--}}

                    {{--<div class="form-check">--}}
                        {{--<input class="form-check-input" type="radio" name="channel" id="exampleRadios1" value="wechatpay" checked>--}}
                        {{--<label class="form-check-label" for="exampleRadios1">--}}
                            {{--微信--}}
                            {{--<img src="/pics/wechatpay.jpg" class="rounded float-left" alt="...">--}}
                        {{--</label>--}}
                    {{--</div>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-sm">--}}
            {{--<div class="card">--}}

                {{--<div class="card-body">--}}

                    {{--<div class="form-check">--}}
                        {{--<input class="form-check-input" type="radio" name="channel" id="exampleRadios1" value="wechatpay" checked>--}}
                        {{--<label class="form-check-label" for="exampleRadios1">--}}
                            {{--支付宝--}}
                            {{--<img src="/pics/alipay.jpg" class="rounded float-left" alt="...">--}}
                        {{--</label>--}}
                    {{--</div>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>



    <div class="card">

        <div class="card-body">

            <button type="submit" class="btn btn-primary">确认</button>


        </div>
    </div>

</form>
@endsection