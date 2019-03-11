@extends('adminlte::page')

@section('title', 'appCentrePlacet')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if ((Auth::user()->phone=='none' )|| (Auth::user()->street=='none')|| (Auth::user()->streetNum=='none')||(Auth::user()->organisationId ==1))
        @lang('app.uncompletProfiel')
    @else
        @lang('app.welkom')
    @endif
@stop