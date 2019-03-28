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

    @if ((Auth::user()->can('show-event-interne'))or ($eventInterne->event->user->id==Auth::user()->id))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="container col-12">
                <div class="row">
                    <div class="col-sm-3">
                        <p> Responsable :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="name">{{$eventInterne->event->user->name.' '.$eventInterne->event->user->firstname}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> evaluation :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="firstname"><a href="{{$eventInterne->evaluation}}">evaluation</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p>programme:</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="address"><a href="{{$eventInterne->programme}}">programme</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> age :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="zip">{{$eventInterne->age}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> participant :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="city"><a href="{{$eventInterne->participant}}">liste participant</a></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> budget :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="phone">{{$eventInterne->budget}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> date :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="mail">{{$eventInterne->event->start_date.' '.$eventInterne->event->startime.' - '.$eventInterne->event->end_date.' '.$eventInterne->event->endtime}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> nom :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="start_date">{{$eventInterne->event->name}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> nombre de participant :</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="end_date">{{$eventInterne->event->numPeopleExp}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> salle:</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="peopleExp">{{$eventInterne->event->room->name}}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class=" row">
    @can('print-event')
         <a href='{{ route('print.show',['id'=>$eventInterne->event->id]) }}' class="btn btn-squared btn-outline-warning">@lang('app.print')</a>
    @endcan
    @can('validate-event')
    <a href='#' class="btn btn-squared btn-outline-warning">@lang('app.validate')</a>
    @endcan
    @can('edit-event')
    <a href='#' class="btn btn-squared btn-outline-warning">@lang('app.edit')</a>
    @endcan
    </div>
    @else
    Vous n'êtes pas authorisé à voir c'est donnée
    @endcan
@stop
