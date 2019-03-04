<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 28/02/2019
 * Time: 11:13
 */
?>
@extends('adminlte::page')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.user')</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{URL::previous()}}"> @lang('app.back')</a>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.name') :</strong>
                {{ $user->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.firstname') :</strong>
                {{ $user->firstname }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.email') :</strong>
                {{ $user->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.adress') :</strong>
                {{ $user->street }} {{ $user->streetNum }} @if(isset ($user->BoxNum))bt {{ $user->BoxNum }} @endif - {{ $user->city->name}}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.phone') :</strong>
                {{ $user->phone }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.organisation') :</strong>
                @if ($user->organisation()->count()>0)
                    @foreach($user->organisation as $v)
                        <label >{{ $v->name }}</label>,
                    @endforeach
                @endif

            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.roles'):</strong>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                @endif
            </div>
        </div>
        @if(auth()->user()->id==$user->id)
            <a href="{{ route('user.edit',[$user->id]) }}"class="btn btn-squared btn-outline-primary">
                <i class="icmn-pencil" aria-hidden="true"></i>
                @lang('app.edit')
            </a>
        @endif
    </div>
@endsection