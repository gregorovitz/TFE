<?php
/**
 * Created by PhpStorm.
 * User: Marqu
 * Date: 25/02/2019
 * Time: 12:25
 */
?>
@extends('adminlte::page')

@section('content')
    <table class="table table-hover nowrap table-bordered" id="table"  width="100%">
        <thead>
        <tr>
            @yield('columnTitle')
        </tr>
        </thead>
        <tbody>
        @yield('foreach')
        </tbody>
    </table>
    <div class="btn-group mr-2 mb-2">
        @yield('create')
    </div>

@stop