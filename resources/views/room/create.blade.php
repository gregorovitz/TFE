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
    <h1>@lang('app.room')</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('room.index') }}"> @lang('app.back')</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> @lang('messages.error_input')<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(['url' => '/room']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.name') :</strong>
                {!! Form::text('name', null, array('placeholder' => __('app.name'),'class' => 'form-control')) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">@lang('app.save')</button>
        </div>
    </div>
    {!! Form::close() !!}



@stop
@section('js')

@stop