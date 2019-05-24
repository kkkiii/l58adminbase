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
        img{
            align; center
            width: auto;
            height: auto;
            max-width: 50%;
            max-height: 50%;

        }
    </style>
@endsection

@section('content')





    <div class="card">

        <div class="text-center card-body" style="background-color: #17b651">

            <img src="/pics/pt_logo.png" class="img-responsive img-circle" alt="Cinque Terre">

        </div>
    </div>




    <div class="card">

        <div class="card-body">


           {!! $template->content !!}


        </div>

        <div class="card-footer text-muted">

        </div>
    </div>


@endsection


