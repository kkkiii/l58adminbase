@extends('layouts.master')

@section('content')





    <div class="card">




        <form action="{{route('customer.login.store')}}" method="post">



            <div class="card-header">
                用户登录
            </div>
            <div class="card-body">

                @csrf


                <div class="form-group">
                    <label for="email">账户</label>
                    <input type="text" class="form-control" name="cellphone"  value="{{old('uname')}}">

                </div>

                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" name="password" value="{{old('password')}}">

                </div>




            </div>


            <div class="card-footer text-muted">
                <div class="form-group">

                    <input type="submit" value="登入" class="form-control" name="commit">
                </div>
            </div>



        </form>


        <div class="alert alert-primary" role="alert">
            还可以<a href="{{route('customer.login.reg')}}" class="alert-link">注册</a>
        </div>
    </div>


@endsection