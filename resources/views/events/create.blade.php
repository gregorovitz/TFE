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
            {!! Form::label('event_name',__('app.event_name')) !!}

            <div class="">
                {!! Form::text('event_name',null,['class'=>'form-control']) !!}
                {!! $errors->first('event_name','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
        {{--<div class="col-xs-4 col-sm-4 col-md-4">--}}
        <div class="form-row">
            <div class="col-md-6 ">

                    {!! Form::label('numPeopleexp',__('app.participant_exp')) !!}

                    <div class="">
                        {!! Form::number('numPeopleexp',10,['class'=>'form-control']) !!}
                        {!! $errors->first('numPeopleexp','<p class="alert alert-danger">:message</p>') !!}

                    </div>
            </div>
            {{--</div>--}}
            {{--<div class="form-group">
                {!! Form::label('typeEventsId',__('app.event_type')) !!}
                <div class="">
                    {!! Form::select('typeEvents',$typesEvents, null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('typeEventsId','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>--}}
            <div class="col-md-6 ">

                    {!! Form::label('organisationId',__('app.organisation')) !!}
                    <div class="">
                        {!! Form::select('organisationId',$organisation,null,['class'=>"form-control"] ) !!}
                        {!! $errors->first('organisationId','<p class="alert alert-danger">:message</p>') !!}

                    </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6 ">
                {!! Form::label('typepeople',__('app.typepeople')) !!}
                <div class="">
                    {!! Form::select('typepeople',['privé','public','uniquement un type de public (à préciser)'],null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('typepeople','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>

            <div class="col-md-6">
                {!! Form::label('otherTypePeople',__('app.otherTypePeople')) !!}

                <div class="">
                    {!! Form::text('otherTypePeople',null,['class'=>'form-control']) !!}
                    {!! $errors->first('otherTypePeople','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('descriptionEvents',__('app.event_description_form')) !!}
            <div class="">
                {!! Form::textarea('descriptionEvents',null,['class'=>"form-control"] ) !!}
                {!! $errors->first('descriptionEvents','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>

        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
        <div class="form-row">
            <div class="col-md-6 ">
                {!! Form::label('start_date',__('app.date_start')) !!}
                <div class="">
                    {!! Form::date('start_date',$date,['class'=>'form-control','id'=>'start']) !!}
                    {!! $errors->first('start_date','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('end_date',__('app.date_end')) !!}
                <div class="">
                    {!! Form::date('end_date',$date,['class'=>'form-control','id'=>'end']) !!}
                    {!! $errors->first('end_date','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        {{--</div>--}}
        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
        <div class="form-row">
            <div class="col-md-6 ">

                {!! Form::label('start_time',__('app.time_start')) !!}
                <div class="">
                    {!! Form::time('start_time',$hour,['class'=>'form-control','id'=>'start_time']) !!}
                    {!! $errors->first('start_time','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>

        {{--</div>--}}
        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}

        {{--</div>--}}
        {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
            <div class="col-md-6">
                {!! Form::label('end_time',__('app.time_end')) !!}
                <div class="">
                    {!! Form::time('end_time',null,['class'=>'form-control','id'=>'end_time']) !!}
                    {!! $errors->first('end_time','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('comment',__('app.comment')) !!}
            <div class="">
                {!! Form::text('comment',null,['class'=>'form-control','id'=>'comment']) !!}
                {!! $errors->first('comment','<p class="alert alert-danger">:message</p>') !!}
            </div>
        </div>
        {{--</div>--}}
    </div>
</div>
<div >&nbsp;
    {!! Form::submit(__('app.add').' '.__('app.Booking'),['class'=>'btn btn-primary']) !!}

</div>

{!! Form::close() !!}

@stop
