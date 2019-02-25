<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 25/02/2019
 * Time: 12:15
 */
?>
@extends('adminlte::page')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.roles')</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index',['lang'=>session('applocale')]) }}"> @lang('app.back')</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.name') :</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.permission') :</strong>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@stop
