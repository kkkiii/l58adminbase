<?php
use Illuminate\Support\Str;
use App\Model\Dict\FarmProduct ;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('product.edit_post') }}" method="POST">
        @csrf



        <input type="hidden" name="company_id" value="{{$company->id}}">
        <input type="hidden" name="product_id" value="{{$product->id}}">

        <div class="form-check form-check-inline form-group">



            <select name="cate1" class="form-control">

                @foreach ($cate1s as $key => $value)
                    <option value="{{$value->big_category}}"
                            @if(\App\Model\Dict\FarmProduct::find($product->cate2)->big_category == $value->big_category)
                            selected="selected"
                            @endif
                    > {{ $value->big_category }}</option>

                @endforeach
            </select>




            <select name="cate2" class="form-control">
                <option  value="{{$product->cate2}}">{{\App\Model\Dict\FarmProduct::find($product->cate2)->small_category }}</option>
            </select>

        </div>



        <div class="form-group">
            <label>规格</label>
            <input type="text" name="variety" class="form-control" value="{{$product->variety}}">
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/farm_farm_product.js') }}"></script>
@endsection