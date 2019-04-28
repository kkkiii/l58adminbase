<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('enterprise.edit_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>公司名</label>
            <input type="text" name="cname" class="form-control" value="{{$company->cname}}">
        </div>
        <div class="form-group">
            <label>统一社会信用代码</label>
            <input type="text" name="unicode" class="form-control" value="{{$company->unicode}}">
        </div>

        <div class="form-group">
            <select name="rtype" class="form-control">
                @foreach ($rtypes as $key => $value)
                    <option value="{{$value->cd}}"
                            @if($company->rtype === $value->cd)
                            selected="selected"
                            @endif
                    > {{ $value->reg_type }}</option>
                @endforeach
            </select>
        </div>

        <input type="hidden" value="{{$company->id}}" name="id">


        <div class="form-check form-check-inline form-group">


            <select name="province" class="form-control">

                @foreach ($provinces as $key => $value)
                    <option value="{{$key}}"
                            @if($company->province_cd == $key)
                            selected="selected"
                            @endif
                    > {{ $value }}</option>

                @endforeach
            </select>




            <select name="city" class="form-control">
                <option  value="{{ $company->city_cd }}">{{ $company->city }}</option>
            </select>



            <select name="district" class="form-control">
                <option  value="{{ $company->district_cd }}">{{ $company->district }}</option>
            </select>


        </div>


        <div class="form-group">
            <label>注册地址</label>
            <input type="text" name="reg_addr" class="form-control" value="{{$company->reg_addr}}">
        </div>


        <div class="form-group">
            <label>法定代表人</label>
            <input type="text" name="legal_person" class="form-control" value="{{$company->legal_person}}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection