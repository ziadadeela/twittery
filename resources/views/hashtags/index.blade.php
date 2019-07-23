@extends('layouts.app')

@section('title', 'User Hashtags')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">--}}

@endsection

@section('content')
    <div class=" table-responsive pagination2"
         style="min-height: 400px;padding-bottom: 100px;margin-top: 10px;">
        {!! $dataTable->table(['class' => 'table table-hover table-striped table-condensed dataTableBuilder','style'=>'width:100%;']) !!}
    </div>
@endsection

@section('js')
    {{--@include('layouts.crud.filters_script')--}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.0/js/dataTables.buttons.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.0/js/buttons.print.min.js">


    {{--{!! $dataTable->assets() !!}--}}
    {!! $dataTable->scripts() !!}
@endsection