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
        @if (Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
        @elseif (Session::has('warning'))
            <div class="alert alert-danger">{{Session::get('warning')}}</div>
        @endif
        <div class="panel-heading">My Event Details</div>
        <div class="panel-body">

            {!! $calendar_details->calendar() !!}

        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Register</h4>
                </div>
                <div class="modal-body">
                    <div>
                        {!! Form::open(['url' => '/event']) !!}
                    <div class ="row">
                        @if (Session::has('success'))
                            <div class="alert alert-success">{{Session::get('success')}}</div>
                        @elseif (Session::has('warning'))
                            <div class="alert alert-danger">{{Session::get('warning')}}</div>
                        @endif
                    </div>
                    {{Form::hidden('roomsId',3,['id'=>'room'])}}
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
                                {!! Form::date('start_date',null,['class'=>'form-control','id'=>'start']) !!}
                                {!! $errors->first('start_date','<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    {{--</div>--}}
                    {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
                        <div class="form-group">
                            {!! Form::label('start_time','Start time:') !!}
                            <div class="">
                                {!! Form::time('start_time',null,['class'=>'form-control','id'=>'start_time']) !!}
                                {!! $errors->first('start_time','<p class="alert alert-danger">:message</p>') !!}
                            </div>
                        </div>
                    {{--</div>--}}
                    {{--<div class="col-xs-3 col-sm-3 col-md-3">--}}
                        <div class="form-group">
                            {!! Form::label('end_date','End Date:') !!}
                            <div class="">
                                {!! Form::date('end_date',null,['class'=>'form-control','id'=>'end']) !!}
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
                    <div class=" text-center modal-footer">&nbsp;
                        {!! Form::submit('Add Event',['class'=>'btn btn-primary']) !!}

                    </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>



@stop

