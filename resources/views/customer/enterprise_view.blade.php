<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')


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
            <td><span class="h1">{{$company->company_name}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">公司编码</code></p>

            </td>
            <td><span class="h2">{{$company->company_code}}</span></td>
        </tr>
        <tr>
            <td>
                <p><code class="highlighter-rouge">类型</code></p>

            </td>
            <td><span class="h3">{{$company->property}}</span></td>
        </tr>

        </tbody>
    </table>

    @if($company->verify == -1)
    <a class="btn btn-primary" href="{{route('enterprise.edit')}}" role="button">修改资料</a>
    @endif

@endsection