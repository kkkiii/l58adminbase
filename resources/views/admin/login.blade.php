@extends('layouts.master')

@section('content')





    <div class="card">




        <form action="{{route('login.store')}}" method="post">



            <div class="card-header">
                用户登录陆
            </div>
            <div class="card-body">

                @csrf


                <div class="form-group">
                    <label for="email">账户</label>
                    {{--<input type="text" class="form-control" name="uname"  value="{{old('uname')}}">--}}
                    <input type="text" class="form-control" name="uname"  value="admin">
                </div>

                <div class="form-group">
                    <label for="password">密码</label>
                    {{--<input type="password" class="form-control" name="password" value="{{old('password')}}">--}}
                    <input type="password" class="form-control" name="password"  value="zqlm2018">
                </div>




            </div>


            <div class="card-footer text-muted">
                <div class="form-group">

                    <input type="submit" value="登入" class="form-control" name="commit">
                </div>
            </div>

        </form>
    </div>


@endsection