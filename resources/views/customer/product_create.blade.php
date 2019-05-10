<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')




    <form action="{{ route('product.create_post') }}" method="POST">
        @csrf



        <div class="form-check form-check-inline form-group">


            <select name="cate1" class="form-control">
                <option value=""> 选一个</option>
                @foreach ($cate1s as $key => $value)
                    <option value="{{$value->code}}"

                    > {{ $value->title }}</option>

                @endforeach
            </select>


            <select name="cate2" class="form-control">
                <option value=""> 选一个</option>
            </select>


        </div>



        <div class="form-group">
            <label>商品名称</label>
            <input type="text" name="sy_goods_name" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>品牌名称</label>
            <input type="text" name="sy_brand_name" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>净含量/规格</label>
            <input type="text" name="sy_package_unit" class="form-control" value="">
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/farm_farm_product.js') }}"></script>
@endsection