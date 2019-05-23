<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('order.create1') }}" method="POST">
        @csrf




        <div class="form-group">
            <label>模板名称{{$template->title}}</label>
            <input type="hidden" name="id"   class="form-control" value="{{$template->id}}">
            <input type="hidden" name="templatename"   class="form-control" value="{{$template->title}}">
        </div>

        <div class="form-group">
            <label>标签价格{{0.05}}</label>
            <input type="hidden" name="unit_price"   class="form-control" value="{{5}}">
        </div>

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
            <button type="submit" class="btn btn-primary">确认</button>
        </div>
    </form>

@endsection

@section('js')
    {{--<script src="{{ asset('js/custom.js') }}"></script>--}}
@endsection