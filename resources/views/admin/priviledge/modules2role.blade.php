<?php
//use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth ;
?>
@extends('layouts.adminbase')

@section('content')



    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">模块名</th>


            <th scope="col">选择</th>

        </tr>
        </thead>
        <tbody>

        <form action="{{route('priviledge.modules2role_post')}}" method="post">
            @csrf
        @foreach ($modules as $item)

            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->name}}</td>



                <td>

                    @if (in_array($item->id ,$moduel_ids))
                        <input type="checkbox" name="opt{{$item->id}}" value="checkbox"  checked="yes" >
                    @else
                        <input type="checkbox" name="opt{{$item->id}}" value="checkbox" >
                    @endif


                </td>

            </tr>

        @endforeach
            <input type="hidden" name="role_id" value="{{$id}}">
            <input type="submit" class="btn btn-info" name="sub" value="选好点我就生效">
            </form>

        </tbody>
    </table>



@endsection