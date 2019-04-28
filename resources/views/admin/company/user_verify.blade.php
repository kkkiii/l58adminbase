<?php
use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')

@section('content')
    <form action="{{ route('company.user_verify_post') }}" method="POST">
        @csrf
    <table class="table">
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <p><code class="highlighter-rouge">公司名</code></p>

            </td>
            <td><span class="h1">{{$company->cname}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">统一社会信用编码</code></p>

            </td>
            <td><span class="h2">{{$company->unicode}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">类型</code></p>

            </td>
            <td><span class="h3">{{$company->reg_ent_type->reg_type}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">省</code></p>

            </td>
            <td><span class="h4">{{$company->province}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">市</code></p>

            </td>
            <td><span class="h5">{{$company->city}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">区</code></p>

            </td>
            <td><span class="h6">{{$company->district}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">审核状态</code></p>

            </td>
            <td><span class="h6">

                            <select name="verify" class="form-control">
                                @foreach ($verifys as $key => $value)
                                    <option value="{{$value->cd}}"
                                            @if($company->company_verify->cd === $value->cd)
                                            selected="selected"
                                            @endif
                                    > {{ $value->name }}</option>
                                @endforeach
                            </select>

<input type="hidden" name="id" value="{{$company->id}}">
                </span></td>
        </tr>
        </tbody>
    </table>
        <button type="submit" class="btn btn-primary">提交生效</button>
    </form>

@endsection

@section('js')
    <script src="{{ asset('js/custom.js') }}"></script>
@endsection