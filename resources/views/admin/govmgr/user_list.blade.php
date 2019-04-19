<?php
use Illuminate\Support\Str;
?>
@extends('layouts.adminbase')

@section('content')
    {{URL::current()}}

    {{ Str::orderedUuid()}}
@endsection