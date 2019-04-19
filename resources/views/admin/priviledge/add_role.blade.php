<?php
use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')

@section('content')

    <form action="{{ route('priviledge.add_role_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>名字</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <textarea  class="form-control"  rows="3" name="remark" >{{old('remark')}}</textarea>
        </div>





        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@endsection