<?php
use Illuminate\Support\Str;
?>
@extends('layouts.customerbase')

@section('content')
    {{URL::current()}}

    {{ Str::orderedUuid()}}
@endsection