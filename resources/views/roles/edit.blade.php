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
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> @lang('app.back')</a>
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


    {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id,'lang'=>session('applocale')]]) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.name'):</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>@lang('app.permission'):</strong>
                <br/>
            <?php $colonne=1;?>
                <table class="col-xs-12 col-sm-12 col-md-12">
                    <tr>
                        @foreach($permission as $value)


                            @if($colonne<=3)

                                <td style="width:30%">
                                    {{Form::label($value->id, __($value->name),array('class'=>'form-check-label col-xs-10 col-sm-10 col-md-10'))}}
                                    {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-check-input col-xs-1 col-sm-1 col-md-1','id'=>$value->id)) }}


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


@endsection