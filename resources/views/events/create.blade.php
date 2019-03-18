<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 14/03/2019
 * Time: 10:34
 */
?>
@extends('adminlte::page')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.Booking') {{$dataroom->name}} </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route("location.show",['id'=>$dataroom->id]) }}"> @lang('app.back')</a>
            </div>
        </div>
    </div>

<div>
    <div>
        {!! Form::open(['url' => '/event']) !!}
        <div class ="row">
            @if (Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
            @elseif (Session::has('warning'))
                <div class="alert alert-danger">{{Session::get('warning')}}</div>
            @endif
        </div>
        {{Form::hidden('roomsId',$dataroom->id,['id'=>'room'])}}
        {!! $errors->first('roomsId','<p class="alert alert-danger">:message</p>') !!}

        {{--<div class="col-xs-4 col-sm-4 col-md-4">--}}
        <div class="form-group">
            {!! Form::label('event_name','Event Name:') !!}

            <div class="">
                {!! Form::text('event_name',null,['class'=>'form-control']) !!}
                {!! $errors->first('event_name','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
        {{--<div class="col-xs-4 col-sm-4 col-md-4">--}}
        <div class="form-group">
            {!! Form::label('numPeopleexp','number of people expected:') !!}

            <div class="">
                {!! Form::number('numPeopleexp',10,['class'=>'form-control']) !!}
                {!! $errors->first('numPeopleexp','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
        <div class="form-group">
            {!! Form::label('typeEventsId',"type d'event : ") !!}
            <div class="">
                {!! Form::select('typeEventsId',$typesEvents, null,['class'=>"form-control"] ) !!}
                {!! $errors->first('typeEventsId','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>

        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
        <div class="form-group">
            {!! Form::label('start_date','Start Date:') !!}
            <div class="">
                {!! Form::date('start_date',$date,['class'=>'form-control','id'=>'start']) !!}
                {!! $errors->first('start_date','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
        <div class="form-group">
            {!! Form::label('start_time','Start time:') !!}
            <div class="">
                {!! Form::time('start_time',$hour,['class'=>'form-control','id'=>'start_time']) !!}
                {!! $errors->first('start_time','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
        <div class="form-group">
            {!! Form::label('end_date','End Date:') !!}
            <div class="">
                {!! Form::date('end_date',$date,['class'=>'form-control','id'=>'end']) !!}
                {!! $errors->first('end_date','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
        <div class="form-group">
            {!! Form::label('end_time','end time:') !!}
            <div class="">
                {!! Form::time('end_time',null,['class'=>'form-control','id'=>'end_time']) !!}
                {!! $errors->first('end_time','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
    </div>
</div>
<div >&nbsp;
    {!! Form::submit('Add Event',['class'=>'btn btn-primary']) !!}

</div>

{!! Form::close() !!}

@stop
