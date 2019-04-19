<?php
use Illuminate\Support\Str;
use App\Biz\Org ;
?>
@extends('layouts.adminbase')

@section('content')


    <form action="{{ route('govmgr.org_list_sub_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>父级组织</label>
            <span>
             {{$org->org_name}}
            </span>
        </div>
        <div class="form-group">
            <label>组织名</label>
            <input type="text" name="org_name" class="form-control" value="">
        </div>


        <input type="hidden" value="{{$org->id}}" name="id">

        <div class="form-group">
        <select name="province" class="form-control">
            <option value="">--选择省--</option>
            @foreach ($provinces as $key => $value)
                <option value="{{ $key }}"> {{ $value }}</option>
            @endforeach
        </select>
        </div>


        <div class="form-group">
        <select name="city" class="form-control">
            <option>--选择城市--</option>
        </select>
        </div>

        <div class="form-group">
            <select name="district" class="form-control">
                <option>--选择区--</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>


@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
    @endsection