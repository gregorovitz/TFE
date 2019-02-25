<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 25/02/2019
 * Time: 12:15
 */
?>
@extends('adminlte::page')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.roles')</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('roles.index',['lang'=>session('applocale')]) }}"> @lang('app.back')</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> @lang('messages.error_input')<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {!! Form::open(['url' => '/roles']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.name') :</strong>
                {!! Form::text('name', null, array('placeholder' => __('app.name'),'class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-check">
                <strong>@lang('site.permission') :</strong>
                <br/>
            <?php $colonne=2;?>
                <table class="col-xs-12 col-sm-12 col-md-12">
                    <tr>
                        {{Form::label('all', 'all',array('class'=>'form-check-label col-xs-10 col-sm-10 col-md-10'))}}
                        {{Form::checkbox('all','all', false, array('class' => 'form-check-input col-xs-1 col-sm-1 col-md-1 ','id'=>"checkAll")) }}


                    @foreach($permission as $value)


                            @if($colonne<=3)

                                <td style="width:30%">
                                    {{Form::label($value->id, $value->name,array('class'=>'form-check-label col-xs-10 col-sm-10 col-md-10'))}}
                                    {{Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input col-xs-1 col-sm-1 col-md-1 check','id'=>$value->id)) }}


                                </td>

                                <?php $colonne++?>

                            @endif
                            @if($colonne>3)

                    </tr>
                    <?php $colonne=1;?>
                    <tr>
                        @endif

                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">@lang('app.save')</button>
        </div>
    </div>
    {!! Form::close() !!}



@stop
@section('js')
    <script>
    $("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
    });
    </script>
@stop