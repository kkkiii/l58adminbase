<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('enterprise.create_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>公司名</label>
            <input type="text" name="cname" class="form-control" value="">
        </div>
        <div class="form-group">
            <label>统一社会信用代码</label>
            <input type="text" name="unicode" class="form-control" value="">
        </div>

        <div class="form-group">
            <select name="rtype" class="form-control">
                <option value=""> 选一个</option>
                @foreach ($rtypes as $key => $value)
                    <option value="{{$value->cd}}"> {{ $value->reg_type }}</option>
                @endforeach
            </select>
        </div>




        <div class="form-check form-check-inline form-group">


            <select name="province" class="form-control">
                <option value="">选一个</option>
                @foreach ($provinces as $key => $value)

                    <option value="{{$key}}"> {{ $value }}</option>
                @endforeach
            </select>




            <select name="city" class="form-control">
                <option  value="">选一个</option>
            </select>



            <select name="district" class="form-control">
                <option  value="">选一个</option>
            </select>


        </div>


        <div class="form-group">
            <label>注册地址</label>
            <input type="text" name="reg_addr" class="form-control" value="">
        </div>


        <div class="form-group">
            <label>法定代表人</label>
            <input type="text" name="legal_person" class="form-control" value="">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection