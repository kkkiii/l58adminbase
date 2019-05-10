<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')


    <?php
//    dump($product) ;
    ?>


    <form action="{{ route('product.edit_post') }}" method="POST">
        @csrf


        <input type="hidden" name="company_id" value="{{$company->id}}">
        <input type="hidden" name="goods_id" value="{{$product->sy_goods_id}}">


        <div class="form-check form-check-inline form-group">


            <select name="cate1" class="form-control">

            @foreach ($cate1s as $key => $value)
                    <option value="{{$value->code}}"
                            @if($value->code == $product->sy_pcate)
                            selected="selected"
                            @endif
                    > {{ $value->title }}</option>

                @endforeach
            </select>


            <select name="cate2" class="form-control">
                <option  value="{{$product->sy_cate_id}}">{{ $product->sy_cgoods }}</option>
            </select>


        </div>



        <div class="form-group">
            <label>商品名称</label>
            <input type="text" name="sy_goods_name" class="form-control" value="{{$product->sy_goods_name}}">
        </div>

        <div class="form-group">
            <label>品牌名称</label>
            <input type="text" name="sy_brand_name" class="form-control" value="{{$product->sy_brand_name}}">
        </div>


        <div class="form-group">
            <label>净含量/规格</label>
            <input type="text" name="sy_package_unit" class="form-control" value="{{$product->sy_package_unit}}">
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/farm_farm_product.js') }}"></script>
@endsection