<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 28/02/2019
 * Time: 11:14
 */
?>
@extends('layouts.view')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.user')</h1>
@stop
@section('columnTitle')
    <th>@lang('app.name')</th>
    <th>@lang('app.firstname')</th>
    <th>@lang('app.email')</th>
    <th>@lang('app.roles')</th>
    <th width="200px">@lang('app.actions')</th>
@endsection
@section('foreach')
    @foreach ($data as $key => $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{$user->firstname}}</td>
            <td>{{ $user->email }}</td>
            <td>
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <label class="badge badge-success">{{ $v }}</label>
                    @endforeach
                @endif
            </td>
            <td>

               {{--@if ((auth()->user()->can('user-list')&&($id==$user->id))||(auth()->user()->hasrole('Admin')))--}}
                    <a href="{{ route('user.show',[$user->id]) }}"class="btn btn-squared btn-outline-success">@lang('app.display')</a>
                {{--@endif--}}
                {{--@if ((auth()->user()->can('user-edit')&&($id==$user->id))||(auth()->user()->hasrole('Admin')))--}}
                    <a href="{{ route('user.edit',[$user->id]) }}"class="btn btn-squared btn-outline-primary">
                        <i class="icmn-pencil" aria-hidden="true"></i>
                        @lang('app.edit')
                    </a>
                {{--@endif--}}

            </td>
        </tr>
    @endforeach
@endsection
{!! $data->render() !!}