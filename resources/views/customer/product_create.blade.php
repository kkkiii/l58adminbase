<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')




    <form action="{{ route('product.create_post') }}" method="POST" class="">
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
            <label>净含量</label>
            <input type="text" name="sy_package_unit" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>商品条码</label>
            <input type="text" name="sy_goods_number" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>计量单位</label>
            <input type="text" name="sy_uom" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>生产日期</label>
            <input type="date" name="sy_production_date" class="form-control" value="">
        </div>






         <div class="form-group row">
                    <label for="inputKey" class="col-md-1 control-label">保质期</label>
                    <div class="col-md-2">
                        <input type="text" name="sy_shelf_life" class="form-control" value="">
                    </div>
                    <label for="inputValue" class="col-md-1 control-label">保质期时间单位</label>
                    <div class="col-md-2">
                        <select class="custom-select" name="sy_uo_shelf_life">
                            <option value="">选一个</option>
                            <option value="年">年</option>
                            <option value="月">月</option>
                            <option value="天">天</option>
                        </select>
                    </div>
          </div>

        <div class="form-group">
            <label>食品等级</label>
            <select class="custom-select" name="sy_goods_level">
                <option value="">选一个</option>
                @foreach($level as $value)
                    <option value="{{$value->code}}">{{$value->goods_level}}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>商品批次</label>
            <input type="text" name="sy_lot" class="form-control" value="">
        </div>

        <div class="form-group">
            <label>产地</label>
            <select class="custom-select" name="sy_origin">
                <option value="">选一个</option>
                @foreach($provinces as $item)
                    <option value="{{$item->code}}">{{$item->name}}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label>商品主要原料成分</label>
            <textarea name="sy_goods_bases" rows="4" cols="60"></textarea>
        </div>

        <div class="form-group">
            <label>商品描述</label>
            <textarea name="sy_goods_desc" rows="4" cols="60"></textarea>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/farm_farm_product.js') }}"></script>
@endsection