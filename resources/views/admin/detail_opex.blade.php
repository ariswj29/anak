@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

@stop

@if(auth()->user()->isAdmin())

@section('content_header')
    <h1 class="m-0 text-dark">Pembelanjaan Operasional</h1>
@stop

@section('content')
<div class="detail-mitra">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   --> <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>  
 
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->table() !!}
    <!-- <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>   -->
    {!! $dataTable->scripts() !!}
</div>

@stop


    
@endif
