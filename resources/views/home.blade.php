@extends('adminlte::page')

@section('title', 'appCentrePlacet')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if ((Auth::user()->phone='none' )|| (Auth::user()->street='none')|| (Auth::user()->street_num='none'))
        @lang('app.uncompletProfiel')
    @else
        @lang('app.welkom')
    @endif
@stop