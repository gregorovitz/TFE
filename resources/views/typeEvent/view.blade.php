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
    <h1>@lang('app.typeEvent')</h1>
@stop
@section('columnTitle')
    <th>@lang('app.name')</th>
    <th width="400px">@lang('app.actions')</th>
@endsection
@section('foreach')

    @foreach ($types as $key => $type)

        <tr>

            <td>{{ $type->name }}</td>
            <td>

                    <a  href="{{ route('typeEvent.edit',[$type->id,'lang'=>session('applocale')]) }}"class="btn btn-squared btn-outline-primary"><i class="icmn-pencil" aria-hidden="true"></i>  @lang('app.edit')</a>

            </td>
        </tr>

    @endforeach
@endsection
{!! $types->render() !!}

{{--@can('template-create')--}}
@section('create')
    <a href='/{!! session("applocale") !!}typeEvent/create' class="btn btn-squared btn-outline-warning">@lang('app.create')</a>
@endsection
{{--@endcan--}}