@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Siklus')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
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
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro"; href="/pjub/siklus/tambah" data-toggle="tooltip" data-placement="bottom" title="Isi ketika ingin menambah siklus baru"><i class="fas fa-plus"></i> Tambah Data</i></a>
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
                <th class="header-tabel-data" scope="col">Tanggal Mulai</th>
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
                    {{ $record->nama_farm }} - {{ $record->nama }}
                </td>
                <td>
                    {{ $record->nama_siklus }} 
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($record->tanggal)->isoFormat('dddd, D MMMM Y') }}
                </td>
                <td>
                    {{ $record->jenis_ternak }}
                </td>
                <td>
                    {{ $record->jumlah_ternak }}
                </td>
                <td>
                {{ $record->mata_uang }}. {{ number_format($record->harga_satuan_doc, 0, ',', '.') }}
                </td>
                <td>
                    {{ $record->supplier }}
                </td>
                <td>
                    <a class="btn btn-info btn-sm my-1" href="/pjub/siklus/{{ $record->siklus_id }}/edit" data-toggle="tooltip" data-placement="bottom" title="Isi ketika ingin mengubah data siklus"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm my-1" href="/pjub/siklus/{{ $record->siklus_id }}/delete" data-toggle="tooltip" data-placement="bottom" title="Isi ketika ingin menghapus data siklus"><i class="fas fa-trash" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"></i></a>
                </td>
            </tr>
            @endforeach
                            
            </tbody>
        </table>
    </div>

    
@stop