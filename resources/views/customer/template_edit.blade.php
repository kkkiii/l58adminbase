<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')




    <form action="{{ route('template.edit_post') }}" method="POST">
        @csrf

<input type="hidden" name="id" value="{{$item->id}}">
        <div class="form-group">
            <label>题目</label>
            <input type="text" name="title" class="form-control" value="{{$item->title}}">
        </div>

        <div class="form-group">
            <label>内容</label>

        </div>

        <div class="form-group">

            <textarea name="content" rows="5" cols="60" id="content">{{$item->content}}</textarea>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="/vendor/ueditor/ueditor.config.js"></script>
    <script src="/vendor/ueditor/ueditor.all.js"></script>
    <script type="text/javascript">
        var ue = UE.getEditor('content');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection