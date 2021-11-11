@extends('adminlte::page')

@section('title', 'Siklus | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Siklus</h1>
@stop

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif    

    <div class="row justify-content-between mt-2">
        <div class="col-md-2">
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro"; href="/mitra/siklus/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="table-responsive">
    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr class="thead">
                <th class="header-tabel-data" scope="col">No.</th>
                <th class="header-tabel-data" scope="col">Farm</th>
                <th class="header-tabel-data" scope="col">Nama Siklus</th>
                <th class="header-tabel-data" scope="col">Tanggal</th>
                <th class="header-tabel-data" scope="col">Jenis Ternak</th>
                <th class="header-tabel-data" scope="col">Jumlah Ternak</th>
                <th class="header-tabel-data" scope="col">Harga Satuan DOC</th>
                <th class="header-tabel-data" scope="col">Supplier</th>
                <th class="header-tabel-data" scope="col">Aksi</th>
            </tr>
            </thead>
            <tbody> 
            @foreach ($recording as $record)
            <tr>
                <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                    {{ $record->no }}
                </td>
                <td>
                    {{ $record->nama_farm }}
                </td>
                <td>
                    {{ $record->nama_siklus }}
                </td>
                <td>
                    {{ $record->tanggal }}
                </td>
                <td>
                    {{ $record->jenis_ternak }}
                </td>
                <td>
                    {{ $record->jumlah_ternak }}
                </td>
                <td>
                    {{ $record->harga_satuan_doc }}
                </td>
                <td>
                    {{ $record->supplier }}
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="/mitra/siklus/{{ $record->siklus_id }}/edit"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
                            
            </tbody>
        </table>
    </div>

    
@stop