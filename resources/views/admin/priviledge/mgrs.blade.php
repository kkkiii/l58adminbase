<?php
use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')

@section('content')



    <a href="{{route('priviledge.add_admin')}}" class="btn btn-primary">增加</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">用户名</th>
            <th scope="col">密码</th>

            <th scope="col">操作</th>

        </tr>
        </thead>
        <tbody>


        @foreach ($users as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->uname}}</td>
                <td>{{$item->password}}</td>


                <td>

                    <a href="/admin/priviledge.roles2mgrs_fill/{{$item->id}}" class="btn btn-info">角色</a>

                    <a href="/admin/priviledge.del/{{$item->id}}" class="btn btn-info">删除</a>
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>

    {{ $users->links()}}


@endsection