<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 21/03/2019
 * Time: 09:41
 */

?>
@extends('layouts.datatable')
@section('title', 'appCentrePlacet')
@section('content_header')
    <h1>@lang('app.permission')</h1>
@stop
@section('content')
    <table class="table table-bordered" id="EventInterne-table">
        <thead>
            <tr>
                <th>id</th>
                <th>@lang('app.name')</th>
                <th>@lang('app.permission')</th>
                <th>@lang('app.created_at')</th>
                <th>@lang('app.updated_at')</th>

            </tr>
        </thead>

    </table>
@stop

@push('js')
    <script>
        $(document).ready(function(){
            $('#EventInterne-table').DataTable({
                processing: true,
                serverSide:true,
                ajax: '{!!route('get.Permission')  !!}',
                columns:[
                    {data:'id', name:'id'},
                    {data:'name', name:'name'},
                    {data:'name_view', name:'name_view'},
                    {data:'created_at', name:'created_at'},
                    {data:'updated_at', name:'updated_at'}

                ]
                }

            );
        });
    </script>
@endPush
