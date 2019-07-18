<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 06/06/2019
 * Time: 19:20
 */

?>
@extends('adminlte::page')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.Booking') </h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href=""> @lang('app.back')</a>
            </div>
        </div>
    </div>

    <div>
        <div>
            {!! Form::open(['method' => 'PATCH','route' => ['print.update', $event->id]]) !!}

            <div class ="row">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @elseif (Session::has('warning'))
                    <div class="alert alert-danger">{{Session::get('warning')}}</div>
                @endif
            </div>
            {!! Form::hidden('id',$event->id,['class'=>'form-control']) !!}
            {!! Form::hidden('organisationid',$event->organisationId,['class'=>'form-control']) !!}
            <div class="form-group">
                {!! Form::label('name',__('contrat.name')) !!}

                <div class="">
                    {!! Form::text('name',$event->user->name.' '.$event->user->firstname,['class'=>'form-control']) !!}
                    {!! $errors->first('name','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('organisation',__('contrat.organisation')) !!}

                <div class="">
                    {!! Form::text('organisation',$event->organisation->name,['class'=>'form-control']) !!}
                    {!! $errors->first('organisation','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('address',__('contrat.address')) !!}

                <div class="">
                    {!! Form::text('address',$event->user->street.' '.$event->user->streetNum.' - '.$event->user->city->zipCode.' '.$event->user->city->name,['class'=>'form-control']) !!}
                    {!! $errors->first('address','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('phone',__('contrat.phone')) !!}

                <div class="">
                    {!! Form::text('phone',$event->user->phone,['class'=>'form-control']) !!}
                    {!! $errors->first('phone','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('mail',__('contrat.mail')) !!}

                <div class="">
                    {!! Form::text('mail',$event->user->email,['class'=>'form-control']) !!}
                    {!! $errors->first('mail','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('date',__('contrat.date')) !!}

                <div class="">
                    @if($event->start_date!=$event->end_date)
                        {!! Form::text('date',$event->start_date.' - '.$event->end_date,['class'=>'form-control']) !!}
                    @else
                        {!! Form::text('date',$event->start_date,['class'=>'form-control']) !!}
                    @endif
                    {!! $errors->first('date','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('schedule',__('contrat.schedule')) !!}

                <div class="">
                    {!! Form::text('schedule',$event->startime.' - '.$event->endtime,['class'=>'form-control']) !!}
                    {!! $errors->first('schedule','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('activity',__('contrat.activity')) !!}

                <div class="">
                    {!! Form::text('activity',$event->description,['class'=>'form-control']) !!}
                    {!! $errors->first('activity','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('people',__('contrat.people')) !!}

                <div class="">
                    {!! Form::number('people',$event->numMaxPeople,['class'=>'form-control']) !!}
                    {!! $errors->first('people','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('montant',__('contrat.montant')) !!}

                <div class="">

                    {!! Form::number('montant',null,['class'=>'form-control']) !!}

                    {!! $errors->first('montant','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('guarantie',__('contrat.guarantie')) !!}

                <div class="">
                    {!! Form::number('guarantie',125,['class'=>'form-control']) !!}
                    {!! $errors->first('guarantie','<p class="alert alert-danger">:message</p>') !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">@lang('app.save')</button>
            </div>

        {!! Form::close() !!}
        </div>
    </div>
@endsection
