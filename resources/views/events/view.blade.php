<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 14/03/2019
 * Time: 13:29
 */
?>
@extends('layouts.datatable')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.Booking')</h1>
@stop
@section('content')
   {{-- <table class="table table-bordered" id="Event-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Organisation</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
        </thead>
    </table>--}}
    {!! $dataTable->table(['class'=>'table table-bordered '],true) !!}
@stop

@push('js')
    {{--<script>
        $(function() {
            $('#Event-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('event.data') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'updated_at', name: 'updated_at' }
                ]
            });
        });
    </script>--}}
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="/js/yarjadatabase/buttons.server-side.js"></script>
    {!! $dataTable->scripts() !!}
@endpush
