<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 11/03/2019
 * Time: 10:50
 */
?>
@extends('layouts.view')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.permission')</h1>
@stop
@section('columnTitle')
    <th>@lang('app.name')</th>
    <th width="400px">@lang('app.actions')</th>
@endsection
@section('foreach')

    @foreach ($permissions as $key => $permission)
        <tr>
            <td>{{ $permission->name }}</td>
            <td>

                {{--@can('permission-edit')--}}
                {{--<a  href="{{ route('permissions.edit',[$permission->id,'lang'=>session('applocale')]) }}"class="btn btn-squared btn-outline-primary"><i class="icmn-pencil" aria-hidden="true"></i>  @lang('app.edit')</a>--}}
                {{--//@endcan--}}
                {{--//@can('permission-delete')--}}
                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id,'lang'=>session('applocale')],'style'=>'display:inline']) !!}
                {!! Form::submit(__('app.remove'), ['class'=>'btn btn-squared btn-outline-danger']) !!}
                {!! Form::close() !!}
                {{--@endcan--}}
            </td>
        </tr>
    @endforeach
@endsection
{!! $permissions->render() !!}

{{--@can('permission-create')--}}
@section('create')
    <a href='/{!! session("applocale") !!}permissions/create' class="btn btn-squared btn-outline-warning">@lang('app.create')</a>
@endsection
{{--@endcan--}}
