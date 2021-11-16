@extends('adminlte::page')

@section('title', 'Vitamin | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Vitamin</h1>
@stop

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif    

    <!-- <div class="row justify-content-between mt-2">
        <div class="col-md-2">
            <a class="btn btn-success mb-2" style="font-family: Source Sans Pro"; href="/mitra/vitamin/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div> -->

    <div class="table-responsive">
    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr class="thead">
                <th class="header-tabel-data" scope="col">No.</th>
                <th class="header-tabel-data" scope="col">Tanggal</th>
                <th class="header-tabel-data" scope="col">Jenis Vitamin</th>
                <th class="header-tabel-data" scope="col">Jumlah Vitamin (l/butir)</th>
                <th class="header-tabel-data" scope="col">Siklus</th>
                <!-- <th class="header-tabel-data" scope="col">Aksi</th> -->
            </tr>
            </thead>
            <tbody> 
            @foreach ($recording as $record)
            <tr>
                <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                    {{ $record->no }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($record->tanggal)->isoFormat('dddd, D MMMM Y') }}
                </td>
                <td>
                    {{ $record->jenis_vitamin }}
                </td>
                <td>
                    {{ $record->jumlah_vitamin }}
                </td>
                <td>
                    {{ $record->nama_siklus }} - {{ $record->nama_farm }}
                </td>
                <!-- <td>
                    <a class="btn btn-info btn-sm" href="/mitra/vitamin/{{ $record->vitamin_id }}/edit"><i class="fas fa-edit"></i></a>
                </td> -->
            </tr>
            @endforeach
                            
            </tbody>
        </table>
    </div>
@stop
