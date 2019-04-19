<?php
//use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')

@section('content')

    {{--<a href="{{route('priviledge.add_role')}}" class="btn btn-primary">增加</a>--}}

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">公司名</th>
            <th scope="col">社会信用代码</th>
            <th scope="col">类型</th>
            <th scope="col">法人</th>

        </tr>
        </thead>
        <tbody>


        @foreach ($companies as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->cname}}</td>
                <td>{{$item->unicode}}</td>

                <td>{{$item->reg_ent_type->reg_type}}</td>

                <td>

                    <a href="/admin/company.user_edit/{{$item->id}}" class="btn btn-info">编辑</a>
                    <a href="/admin/priviledge.del/{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">删除</a>
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>

    {{ $companies->links()}}

@endsection