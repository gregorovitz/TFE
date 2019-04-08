<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 12/03/2019
 * Time: 13:13
 */

?>
@extends('adminlte::page')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.events')</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="/{{ url()->previous() == url('/') ? '/' : preg_replace('@' . url('/') . '/@', '', url()->previous()) }}"> @lang('app.back')</a>
            </div>
        </div>
    </div>

    @if ((Auth::user()->can('show-event'))or ($event->user->id==Auth::user()->id))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="container col-12">
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.name') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="name">{{$event->user->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.firstname') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="firstname">{{$event->user->firstname}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.organisation') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="organisation">{{$event->user->organisation->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p>@lang('app.adress') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="address">{{$event->user->street.' '.$event->user->streetNum}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.zip') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="zip">{{$event->user->city->zipCode}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('city') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="city">{{$event->user->city->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.phone') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="phone">{{$event->user->phone}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.email') :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="mail">{{$event->user->email}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.date_start') </p>
                    </div>
                    <div class="col-sm-8">
                        <p id="start_date">{{$event->start_date.' '.$event->startime}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.date_end') </p>
                    </div>
                    <div class="col-sm-8">
                        <p id="end_date">{{$event->end_date.' '.$event->endtime}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.event_type') </p>
                    </div>
                    <div class="col-sm-8">
                        <p id="type">@if(!empty($event->type))
                                @foreach($event->type as $v)

                                    {!! $v->name !!}
                                @endforeach
                            @endif</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.participant_exp')</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="peopleExp">{{$event->numPeopleExp}}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class=" row">
    @can('print-event')
         <a href='{{ route('print.show',['id'=>$event->id]) }}' class="btn btn-squared btn-outline-warning">@lang('app.print')</a>
    @endcan
    @can('validate-event')
    <a href='{{ route('event.validate',['id'=>$event->id]) }}' class="btn btn-squared btn-outline-warning">@lang('app.validate')</a>
    @endcan
    @can('edit-event')
    <a href='#' class="btn btn-squared btn-outline-warning">@lang('app.edit')</a>
    @endcan
    </div>
    @else
    @lang("app.unauthorize_show")
    @endcan
@stop
