<?php
use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')

@section('content')

    <form action="{{ route('priviledge.edit_role_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>名字</label>
            <input type="text" name="name" class="form-control" value="{{$role->name}}">
        </div>
        <div class="form-group">
            <label>描述</label>
            <textarea  class="form-control"  rows="3" name="remark" >{{$role->remark}}</textarea>
        </div>


        <input type="hidden" name="id" class="form-control" value="{{$role->id}}">


        <button type="submit" class="btn btn-primary">提交</button>
    </form>

@endsection