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
    {{--<table class="table table-bordered" id="EventInterne-table">
        <thead>
        <tr>
            <th>id</th>
            <th>room</th>
            <th>date</th>
            <th>programme</th>
            <th>budget</th>
            <th>evaluation</th>
            <th>create_at</th>
            <th>update_at</th>

        </tr>
        </thead>
    </table>--}}
    {!! $dataTable->table(['class'=>'table table-bordered '],true) !!}
@stop

@push('js')
   {{-- <script>
        $(document).ready(function(){
            $('#EventInterne-table').DataTable({
                processing: true,
                serverSide:true,
                ajax: '{!!route('eventInterne_supprimer.data')  !!}',
                columns:[
                {data: 'id', name: 'id'},
                {data:'room',name:'room'},
                {data:'date',name:'date'},
                {data: 'programme', name: 'programme'},
                {data:'budget',name:'budget'},
                {data: 'evaluation', name: 'evaluation'},
                {data: 'created_at', name: 'created_at'},
                // {data: 'updated_at', name: 'updated_at'}
            ],
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        //example for removing search field
                        // if (column.footer().className !== 'non_searchable') {
                            var input = document.createElement("input");
                            $(input).appendTo($(column.footer()).empty())
                                .keyup(function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                        // }
                    });
                }

                });

        });
    </script>--}}
    {!! $dataTable->scripts() !!}
@endpush
