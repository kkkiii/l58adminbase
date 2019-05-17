<?php
//use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.adminbase')

@section('content')

    {{--<a href="{{route('priviledge.add_role')}}" class="btn btn-primary">增加</a>--}}

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>

            <th scope="col">公司</th>

            <th scope="col">数量</th>

            <th scope="col">合计</th>

            <th scope="col">创建日期</th>

            <th scope="col">流程阶段</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>


        @foreach ($orders as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>

                <th scope="col">{{
                $item->wst_company->company_name
                }}</th>

                <td>{{$item->id}}</td>

                <td>{{$item->tot_money/100}}</td>



                <td>
                    {{$item->created_at}}
                </td>
                <td>
                    {{$item->flowstop->title}}
                </td>
                <td>

                    @if($item->flow_stop == 1)
                    <a href="/admin/order.dispatch/{{$item->id}}" onclick="return confirm('Are you sure?')" class="btn btn-info">派发</a>
                        @endif
                </td>
            </tr>

        @endforeach



        </tbody>
    </table>

    {{ $orders->links()}}

@endsection