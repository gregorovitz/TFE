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
    <h1>@lang('app.organisation')</h1>
@stop
@section('columnTitle')
    <th>@lang('app.name')</th>
    <th width="400px">@lang('app.actions')</th>
@endsection
@section('foreach')

    @foreach ($organisations as $key => $organisation)

        <tr>

            <td>{{ $organisation->name }}</td>
            <td>

                    <a  href="{{ route('organisation.edit',[$organisation->id]) }}"class="btn btn-squared btn-outline-primary"><i class="icmn-pencil" aria-hidden="true"></i>  @lang('app.edit')</a>
                {!! Form::open(['method' => 'DELETE','route' => ['organisation.destroy', $organisation->id],'style'=>'display:inline']) !!}
                {!! Form::submit(__('app.remove'), ['class'=>'btn btn-squared btn-outline-danger']) !!}
                {!! Form::close() !!}
            </td>
        </tr>

    @endforeach
@endsection
{!! $organisations->render() !!}

{{--@can('template-create')--}}
@section('create')
    <a href='/{!! session("applocale") !!}organisation/create' class="btn btn-squared btn-outline-warning">@lang('app.create')</a>
@endsection
{{--@endcan--}}