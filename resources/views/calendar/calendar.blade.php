<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 04/03/2019
 * Time: 11:08
 */

?>
@extends('adminlte::page')
@section('css')
    <link rel="stylesheet" href="/css/fullcalendar-3.10.0/fullcalendar.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="/js/fullcalendar-3.10.0/fullcalendar.min.js"></script>
    <script src="/js/fullcalendar-3.10.0/fr.js"></script>
    {!! $calendar_details->script() !!}

@endsection
@section('content')
    <div class ="panel panel-primary">
        <div class="panel-heading">@lang("app.info")</div>
        <div class="panel-body">
            <p>contact : Baptiste Mertens </p>
            <p>tel:010/479.799</p>
            <p>mail:<a href="mailto:e.marquebreucq@students.ephec.be?subject=Feedback">Baptiste.mertens@placet.be</a> </p>
            <p>adresse:1348 louvain-la-neuve 2 rue des sports</p>
        </div>
    </div>

    <div class ="panel panel-primary">
        <div class="panel-heading">@lang("app.calendar_title",['room'=>$Room->name])</div>
        <div class="panel-body">
            {!! $calendar_details->calendar() !!}
        </div>
    </div>
@stop

