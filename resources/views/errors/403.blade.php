@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
<<<<<<< HEAD
@section('message', __($exception->getMessage() .'sdfsdfs' ?: 'Forbidden'))
=======
@section('message', __($exception->getMessage() ?: 'Forbidden1'))
>>>>>>> fcdcbb231111521406b5bcdfec2b515642096a19

