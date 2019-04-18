<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 16/04/2019
 * Time: 10:02
 */
echo $user->id;

print_r('roles');
?>
@extends('layouts.form')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.user')</h1>
@stop
@section('card')
    @component('component.card')
        @slot('title')
        @endslot
        {!! Form::open(['method' => 'Post', 'files'=>true, 'route' => ['user_role.update',$user->id]]) !!}
        {!! Form::token()  !!}
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