<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('product.edit_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>产品名</label>
            <input type="text" name="pname" class="form-control" value="{{$product->pname}}">
        </div>


      <input type="hidden" name="company_id" value="{{$company->id}}">

        <input type="hidden" name="product_id" value="{{$product->id}}">





        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')

@endsection