@extends('layouts.phonebase')

@section('style')
<style>
    .top {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        background-color: #0cb658;
        text-align: center;
    }
</style>
@endsection

@section('content')





            <div class="card">

                <div class="card-body">

            <img src="/pics/pt_logo.png" class="img-responsive img-circle" alt="Cinque Terre">

        </div>
            </div>




    <div class="card">

        <div class="card-body">


            <h3>公司信息</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{$company->province}}</li>
                <li class="list-group-item">{{$company->city}}</li>
                <li class="list-group-item">{{$company->company_code}}</li>
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


