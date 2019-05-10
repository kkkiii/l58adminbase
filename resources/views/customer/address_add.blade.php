<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('my_address.add_post') }}" method="POST">
    @csrf



        <div class="form-check form-check-inline form-group">



            <select name="province" class="form-control">
                <option  value=""></option>
                @foreach ($provinces as $key => $value)
                    <option value="{{$key}}"

                    > {{ $value }}</option>

                @endforeach
            </select>



            <select name="city" class="form-control">
                <option  value=""></option>
            </select>



            <select name="district" class="form-control">
                <option  value=""></option>
            </select>


        </div>



        <div class="form-group">
            <label>详细地址</label>
            <input type="text" name="addr_detail" class="form-control" value="">
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
   <script src="{{ asset('js/custom.js') }}"></script>
@endsection