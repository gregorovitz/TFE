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
        @if ($organisation->id !=1)
        <tr>

            <td>{{ $organisation->name }}</td>
            <td>

                    <a  href="{{ route('organisation.edit',[$organisation->id,'lang'=>session('applocale')]) }}"class="btn btn-squared btn-outline-primary"><i class="icmn-pencil" aria-hidden="true"></i>  @lang('app.edit')</a>

            </td>
        </tr>
        @endif
    @endforeach
@endsection
{!! $organisations->render() !!}

{{--@can('template-create')--}}
@section('create')
    <a href='/{!! session("applocale") !!}organisation/create' class="btn btn-squared btn-outline-warning">@lang('app.create')</a>
@endsection
{{--@endcan--}}