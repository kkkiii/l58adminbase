<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')


    <a class="btn btn-primary"  href="{{route('template.create')}}" role="button">创建</a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">题目</th>


            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($recs as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>

                <td>
                    {{$item->title}}
                </td>



                <td>
                    @if($item->is_edit == 0)
                    <a href="/customer/template.edit/{{$item->id}}" class="btn btn-info">编辑</a>
                    @endif
                        @if($item->is_edit == 0)
                            <a href="/customer/template.del/{{$item->id}}" class="btn btn-info">删除</a>
                        @endif

                    <a href="{{   url('common/qrcode-g') . '/'.  ( $item->id) }}" target="_blank" class="btn btn-info">预览</a>
                    <a href="/customer/order.create/{{$item->id}}" class="btn btn-info">加入购物车</a>
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>

    {{ $recs->links()}}

@endsection