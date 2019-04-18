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
    <h1>@lang('app.room')</h1>
@stop
@section('columnTitle')
    <th>@lang('app.name')</th>
    <th width="400px">@lang('app.actions')</th>
@endsection
@section('foreach')

    @foreach ($rooms as $key => $room)
        @if ($room->id !=1)
        <tr>

            <td>{{ $room->name }}</td>
            <td>

                    <a  href="{{ route('room.edit',[$room->id,'lang'=>session('applocale')]) }}"class="btn btn-squared btn-outline-primary"><i class="icmn-pencil" aria-hidden="true"></i>  @lang('app.edit')</a>

            </td>
        </tr>
        @endif
    @endforeach
@endsection
{!! $rooms->render() !!}

{{--@can('template-create')--}}
@section('create')
    <a href='/{!! session("applocale") !!}room/create' class="btn btn-squared btn-outline-warning">@lang('app.create')</a>
@endsection
{{--@endcan--}}