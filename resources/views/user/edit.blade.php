<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 28/02/2019
 * Time: 11:13
 */
?>
@extends('layouts.form')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.user')</h1>
@stop
@section('card')
    @component('component.card')
        @slot('title')
            profil : {{$user->firstname}} {{$user->name}}
        @endslot
        {!! Form::open(['method' => 'PUT', 'files'=>true, 'route' => ['user.update',$user->id]]) !!}
        {!! Form::token()  !!}
        @if(auth()->user()->id==$user->id)
            <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                       placeholder="{{ trans('adminlte::adminlte.full_name') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('name'))
                    <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('firstname') ? 'has-error' : '' }}">
                <input type="text" name="firstname" class="form-control" value="{{ $user->firstname }}"
                       placeholder="{{ trans('adminlte::adminlte.first_name') }}">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @if ($errors->has('firstname'))
                    <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('street') ? 'has-error' : '' }}">
                <input type="text" name="street" class="form-control" @if($user->street!="none")value="{{$user->street }} " @endif
                       placeholder="{{ trans('adminlte::adminlte.street') }}">
                <span class="glyphicon glyphicon-home form-control-feedback"></span>
                @if ($errors->has('street'))
                    <span class="help-block">
                            <strong>{{ $errors->first('street') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('streetNum') ? 'has-error' : '' }}">
                <input type="text" name="streetNum" class="form-control"@if($user->streetNum!="none") value="{{$user->streetNum }}" @endif
                       placeholder="{{ trans('adminlte::adminlte.streetNum') }}">
                <span class="glyphicon glyphicon-home form-control-feedback"></span>
                @if ($errors->has('streetNum'))
                    <span class="help-block">
                            <strong>{{ $errors->first('streetNum') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('boxNum') ? 'has-error' : '' }}">
                <input type="text" name="boxNum" class="form-control" value="{{ $user->boxNum }}"
                       placeholder="{{ trans('adminlte::adminlte.box') }}">
                <span class="glyphicon glyphicon-home form-control-feedback"></span>
                @if ($errors->has('boxNum'))
                    <span class="help-block">
                            <strong>{{ $errors->first('boxNum') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
                <input type="text" name="phone" class="form-control" @if($user->phone!="none") value="{{ $user->phone }}" @endif
                       placeholder="{{ trans('adminlte::adminlte.phone') }}">
                <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                @if ($errors->has('phone'))
                    <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('cityId') ? 'has-error' : '' }}">
                {!! Form::select('cityId',$cities, $user->city->cityId,['class'=>"form-control"] ) !!}
                @if ($errors->has('cityId'))
                    <span class="help-block">
                            <strong>{{ $errors->first('cityId') }}</strong>
                        </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('organisationId') ? 'has-error' : '' }}">
            {!! Form::select('organisationId',$organisation, $user->organisation->id,['class'=>"form-control"] ) !!}
            @if ($errors->has('organisationId'))
                <span class="help-block">
                            <strong>{{ $errors->first('organisationId') }}</strong>
                </span>
            @endif
            </div>

            <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                       placeholder="{{ trans('adminlte::adminlte.email') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>

            @if ($user->isNew==1)
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.retype_password') }}">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            @endif

        @endif
        @if(auth()->user()->can('user-change-role'))
            <div class="form-group row">
                <label for="function" class="col-sm-2 col-form-label ">@lang('app.roles')</label>
                <div class="col-md-10">
                    {!! Form::select('function', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                    @if ($errors->has('function'))
                        <span class="invalid-feedback">
                                    <strong>{{ $errors->first('function') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
        @endif
            @component('component.button')
                @lang('app.save')
            @endcomponent
        </form>
    @endcomponent



@stop