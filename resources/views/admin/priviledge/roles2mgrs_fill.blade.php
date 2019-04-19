<?php
//use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth ;
?>
@extends('layouts.adminbase')

@section('content')



    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">角色名</th>
            <th scope="col">描述</th>
            <th scope="col">状态</th>
            <th scope="col">选择</th>

        </tr>
        </thead>
        <tbody>

        <form action="{{route('priviledge.roles2mgrs_fill_post')}}" method="post">
            @csrf
            @foreach ($roles as $item)

                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->remark}}</td>

                    <td>{{$item->status}}</td>


                    <td>

                        @if ($item->admin_id === $id)
                            <input type="checkbox" name="opt{{$item->id}}" value="checkbox"  checked="yes" >
                        @else
                            <input type="checkbox" name="opt{{$item->id}}" value="checkbox" >
                        @endif


                    </td>

                </tr>

            @endforeach


            <input type="hidden" name="uid" value="{{$id}}">
            <input type="submit" class="btn btn-info" name="sub" value="选好点我就生效">

        </form>

        </tbody>
    </table>



@endsection