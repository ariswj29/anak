@extends('adminlte::page')

@section('title', 'Berat Ayam | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Berat Ayam</h1>
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
            <a class="btn btn-success mb-2" style="" href="/pjub/berat/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="table-responsive">
    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
            <thead>
            <tr class="thead">
                <th class="header-tabel-data" scope="col">No.</th>
                <th class="header-tabel-data" scope="col">Tanggal</th>
                <th class="header-tabel-data" scope="col">Rata-rata Berat Ternak (g)</th>
                <th class="header-tabel-data" scope="col">Siklus</th>
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
                    {{ \Carbon\Carbon::parse($record->tanggal)->isoFormat('D MMMM Y') }}
                </td>
                <td>
                    {{ $record->rata_rata_berat }}
                </td>
                <td>
                    {{ $record->nama_siklus }} - {{ $record->nama_farm }} - {{ $record->nama }}
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="/pjub/berat/{{ $record->berat_id }}/edit"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger btn-sm" href="/pjub/berat/{{ $record->berat_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
                            
            </tbody>
        </table>
    </div>
    
@stop
