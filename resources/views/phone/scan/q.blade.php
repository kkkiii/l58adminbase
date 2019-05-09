@extends('layouts.phonebase')





@section('content')
    <div class="card">

        <div class="card-header">
           扫码出来的页面
        </div>
        <div class="card-body">


            <h3>公司信息</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$company->province}}</li>
                <li class="list-group-item">{{$company->city}}</li>
                <li class="list-group-item">{{$company->company_name}}</li>
            </ul>


            <h3>商品信息</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$product->sy_goods_name }}</li>
                <li class="list-group-item">{{$product->sy_brand_name}}</li>
            </ul>



        </div>


        <div class="card-footer text-muted">

        </div>
    </div>
@endsection


