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
            <th scope="col">类别</th>
            <th scope="col">品种</th>

            <th scope="col">申请码类型</th>
            <th scope="col">单价</th>
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
                <th scope="col">
                @if($item->product->cate2)
                        <?php
                        $f = FarmProduct::find($item->product->cate2) ;
                       echo     $f->big_category .$f->goods_category ;
                        ?>
                    @endif
                </th>
                <th scope="col">{{$item->product->variety}}</th>
                <td>{{$item->code_tag_type->title}}</td>
                <td>{{$item->unit_price/100}}</td>
                <td>{{$item->code_amount}}</td>

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