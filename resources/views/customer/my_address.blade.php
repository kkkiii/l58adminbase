<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')




@section('content')

    <a href="{{route('my_address.add_post')}}" class="btn btn-primary">增加</a>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">省市区</th>
            <th scope="col">详细</th>
            <th scope="col">是否缺省</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($address as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->province .$item->city . $item->district }}</td>
                <td>{{$item->addr_detail}}</td>
                <td>
                    @if($item->is_default == 1)
                        <i class="fas fa-user-check"></i>
                    @endif


                </td>



                <td>
                    <a href="/customer/my_address.edit/{{$item->id}}" class="btn btn-info">编辑</a>
                    <a href="/customer/my_address.del/{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">删除</a>
                    @if($item->is_default == 0)
                        <a href="/customer/my_address.default/{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">设为缺省</a>
                    @endif
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>



@endsection