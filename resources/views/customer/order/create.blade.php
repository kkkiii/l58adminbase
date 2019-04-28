<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('order.create1') }}" method="POST">
        @csrf


        <input type="hidden" name="product_id" value="{{$id}}">


        <div class="form-group">
            <label>申请多少个码标</label>
            <input type="text" name="code_amount" class="form-control" value="">
        </div>


        <div class="form-group">
            <label>码标种类</label>
        <select name="code_type" class="form-control" disabled>
            <option >--选一个码标--</option>
            <option  value="1" selected="selected" >图片二维码贴标</option>
            <option  value="2"> RFID芯码合一</option>
            <option  value="3">NB-IoT+看门狗</option>
        </select>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">下一步</button>
        </div>
    </form>

@endsection

@section('js')
    {{--<script src="{{ asset('js/custom.js') }}"></script>--}}
@endsection