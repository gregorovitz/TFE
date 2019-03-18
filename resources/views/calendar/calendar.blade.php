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
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="/js/fullcalendar-3.10.0/fullcalendar.min.js"></script>
    <script src="/js/fullcalendar-3.10.0/fr.js"></script>
    {!! $calendar_details->script() !!}

@endsection
@section('content')
    <div class ="panel panel-primary">
        <div class="panel-heading">My Event Details</div>
        <div class="panel-body">
            {!! $calendar_details->calendar() !!}
        </div>
    </div>
@stop

