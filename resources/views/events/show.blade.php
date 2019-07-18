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
    @auth
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
                        <p id="organisation">{{$event->organisation->name}}</p>
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
                        <p> @lang('app.description') </p>
                    </div>
                    <div class="col-sm-8">
                        <p id="type">{{$event->description}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.participant_exp')</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="peopleExp">{{$event->numMaxPeople}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <p> @lang('app.comment')</p>
                    </div>
                    <div class="col-sm-8">
                        <p id="peopleExp">{{$event->commentaire}}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
        {{$event->status}}
    <div class=" row">

        @if($event->status=='request')
            @can('print-event')
                 <a href='{{ route('print.show',['id'=>$event->id]) }}' class="btn btn-squared btn-outline-warning">@lang('app.print')</a>
            @endcan

        @elseif($event->status=="signature waiting")
            @can('validate-event')
                    <a href="#" class="btn  btn-squared btn-outline-warnin" id="commuModal">@lang('app.validate')</a>

            @endcan
        @elseif($event->status=="validate")

            @can('payment-validation-event')

                    <a href='{{ route('event.payement',['id'=>$event->id]) }}' class="btn btn-squared btn-outline-warning">@lang('app.payement')</a>

            @endcan
        @endif
    </div>
    @else
    @lang("app.unauthorize_show")
    @endcan
    @endauth
    <!-- Modal -->
    <div class="modal fade" id="communication-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Communication</h4>
                </div>
                <div class="modal-body">

                    <form id="formRegister" class="form-horizontal" role="form" method="POST" action="{{ url('/validate/'.$event->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="communication">
                                <small class="help-block"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" name="total" value=>
                                <small class="help-block"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('app.save')
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop
@push('js')
    <script>
        $(function(){
            $("#commuModal").click(function(){
                $('#communication-modal').modal();

            });
            $(document).on('submit', '#commuForm', function(e) {
                e.preventDefault();

                $('input+small').text('');
                $('input').parent().removeClass('has-error');

                $.ajax({
                    method: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json"
                })
                    .done(function(data) {
                        $('.alert-success').removeClass('hidden');
                        $('#myModal').modal('hide');
                    })
                    .fail(function(data) {
                        $.each(data.responseJSON, function (key, value) {
                            var input = '#commuForm input[name=' + key + ']';
                            $(input + '+small').text(value);
                            $(input).parent().addClass('has-error');
                        });
                    });
            });

        })

    </script>


@endpush