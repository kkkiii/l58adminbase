<?php
use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')

@section('content')

    <form action="{{ route('priviledge.add_admin_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>用户名</label>
            <input type="text" name="uname" class="form-control" value="{{$admin->uname}}">
        </div>
        <div class="form-group">
            <label>密码</label>
            <input type="password" name="password" class="form-control" value="{{old('password')}}">
        </div>





        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@endsection