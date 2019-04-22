<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')

    <form action="{{ route('product.create_post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>产品名</label>
            <input type="text" name="pname" class="form-control" value="">
        </div>


      <input type="hidden" name="company_id" value="{{$company->id}}">







        <div class="form-group">
            <button type="submit" class="btn btn-primary">保存</button>
        </div>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection