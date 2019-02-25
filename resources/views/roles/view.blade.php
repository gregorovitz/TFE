<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 25/02/2019
 * Time: 12:16
 */
?>
@extends('layouts.view')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.roles')</h1>
@stop
@section('columnTitle')
    <th>@lang('app.name')</th>
    <th width="400px">@lang('app.actions')</th>
@endsection
@section('foreach')

    @foreach ($roles as $key => $role)
        <tr>
            <td>{{ $role->name }}</td>
            <td>
                <a  href="{{ route('roles.show',[$role->id]) }}"class="btn btn-squared btn-outline-success">@lang('app.display')</a>
                {{--@can('role-edit')--}}
                    <a  href="{{ route('roles.edit',[$role->id,'lang'=>session('applocale')]) }}"class="btn btn-squared btn-outline-primary"><i class="icmn-pencil" aria-hidden="true"></i>  @lang('app.edit')</a>
                {{--//@endcan--}}
                {{--//@can('role-delete')--}}
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id,'lang'=>session('applocale')],'style'=>'display:inline']) !!}
                    {!! Form::submit(__('app.remove'), ['class'=>'btn btn-squared btn-outline-danger']) !!}
                    {!! Form::close() !!}
                {{--@endcan--}}
            </td>
        </tr>
    @endforeach
@endsection
{!! $roles->render() !!}

{{--@can('template-create')--}}
@section('create')
    <a href='/{!! session("applocale") !!}roles/create' class="btn btn-squared btn-outline-warning">@lang('app.create')</a>
@endsection
{{--@endcan--}}