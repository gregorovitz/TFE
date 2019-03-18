<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 18/03/2019
 * Time: 11:46
 */
?>

@extends('adminlte::page')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.Activities') {{$dataroom->name}} </h1>
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
            {!! Form::open(['url' => '/eventInterne']) !!}
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
                {!! Form::label('secteur','secteur:') !!}

                <div class="">
                    {!! Form::select('secteur',$secteur,null,['class'=>'form-control']) !!}
                    {!! $errors->first('secteur','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            {{--</div>--}}
            <div class="form-group">
                {!! Form::label('program',"Lien vers le Programme d'activité : ") !!}
                <div class="">
                    {!! Form::text('program', null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('program','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('people',"Nombre de participant : ") !!}
                <div class="">
                    {!! Form::number('people', null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('people','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('participant',"Lien vers list de participant : ") !!}
                <div class="">
                    {!! Form::text('participant', null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('participant','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('age',"age des participants : ") !!}
                <div class="">
                    {!! Form::text('age', null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('age','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('eval',"Lien vers évaluation activité : ") !!}
                <div class="">
                    {!! Form::text('eval', null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('eval','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    {!! Form::label('partenaire',"Partenaires : ") !!}
                    <div class="">
                        {!! Form::select('partenaire',$partenaire, null,['class'=>"form-control"] ) !!}
                        {!! $errors->first('partenaire','<p class="alert alert-danger">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group col">
                    {!! Form::label('partenaireAdd',"Ajouter Partenaires : ") !!}
                    <div class="">
                        {!! Form::text('partenaireAdd', null,['class'=>"form-control"] ) !!}
                        {!! $errors->first('partenaireAdd','<p class="alert alert-danger">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('budget',"budget : ") !!}
                <div class="">
                    {!! Form::number('budget', null,['class'=>"form-control"] ) !!}
                    {!! $errors->first('budget','<p class="alert alert-danger">:message</p>') !!}
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

