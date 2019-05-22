<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')




    <form action="{{ route('template.create_post') }}" method="POST" class="">
        @csrf


        <div class="form-group">
            <label>题目</label>
            <input type="text" name="title" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>内容</label>

        </div>

        <div class="form-group">

            <textarea name="content" rows="5" cols="60" id="goods_desc"></textarea>
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
        var ue = UE.getEditor('goods_desc');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection