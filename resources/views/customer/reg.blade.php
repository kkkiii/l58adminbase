@extends('layouts.master')

@section('content')





    <div class="card">




        <form action="{{route('customer.reg.store')}}" method="post">



            <div class="card-header">
                手机号验证
            </div>
            <div class="card-body">

                @csrf


                <div class="form-group">
                    <label for="email">手机号</label>
                    {{--<input type="text" class="form-control" name="uname"  value="{{old('uname')}}">--}}
                    <input type="text" id="phone" class="form-control" name="cellphone"  value="15738808900">
                </div>

                <div class="form-group">


                        <label class="label" for="code">验证码：</label>
                        <div class="controls">
                            <input type="text" name="vcode" id="code" class="txt">
                            <span  class="badge badge-secondary btn btn-small get-code" onclick="getCode(this)" id="J_getCode">获取验证码</span>
                            <button class="btn btn-small reset-code" id="J_resetCode" style="display:none;"><span id="J_second">60</span>秒后重发</button>
                        </div>


                </div>

                <div class="form-group">
                    <label for="password">密码</label>
                    {{--<input type="text" class="form-control" name="uname"  value="{{old('uname')}}">--}}
                    <input type="text" id="password" class="form-control" name="password"  value=""/>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">再输入密码</label>
                    {{--<input type="text" class="form-control" name="uname"  value="{{old('uname')}}">--}}
                    <input type="text" id="password_confirmation" class="form-control" name="password_confirmation"  value=""/>
                </div>


            </div>


            <div class="card-footer text-muted">
                <div class="form-group">

                    <input type="submit" value="注册" class="form-control" name="commit">
                </div>
            </div>



        </form>


        <div class="alert alert-primary" role="alert">
            返回<a href="{{route('customer.login')}}" class="alert-link">登录</a>
        </div>
    </div>


@endsection

@section('js')

    <script src="/js/customer/countdown.js"></script>
    @endsection