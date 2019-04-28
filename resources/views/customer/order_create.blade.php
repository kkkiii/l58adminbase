<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('order.create_post') }}" method="POST">
        @csrf



        <input type="hidden" name="id" value="{{$address->id}}">


        <div class="form-check form-check-inline form-group">



            <select name="province" class="form-control">

                @foreach ($provinces as $key => $value)
                    <option value="{{$key}}"
                            @if($address->province_cd == $key)
                            selected="selected"
                            @endif
                    > {{ $value }}</option>

                @endforeach
            </select>



            <select name="city" class="form-control">
                <option  value="{{ $address->city_cd }}">{{ $address->city }}</option>
            </select>



            <select name="district" class="form-control">
                <option  value="{{ $address->district_cd }}">{{ $address->district }}</option>
            </select>


        </div>



        <div class="form-group">
            <label>详细地址</label>
            <input type="text" name="addr_detail" class="form-control" value="{{$address->addr_detail}}">
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')

@endsection