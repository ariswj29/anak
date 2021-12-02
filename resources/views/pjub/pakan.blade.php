@extends('adminlte::page')

@section('title', ' Konsumsi Pakan | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Pakan</h1>
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
            <a class="btn btn-success mb-2" href="/pjub/pakan/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="table-responsive">
      <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr class="thead">
                    <td class="header-tabel-data" scope="col">No.</td>
                    <td class="header-tabel-data" scope="col">Tanggal</td>
                    <td class="header-tabel-data" scope="col">Jenis Pakan</td>
                    <td class="header-tabel-data" scope="col">Jumlah Pakan (kg)</td>
                    <td class="header-tabel-data" scope="col">Pakan yang digunakan (kg)</td>
                    <td class="header-tabel-data" scope="col-5">Siklus</td>
                    <td class="header-tabel-data" scope="col">Aksi</td>
                </tr>
            </thead>
            <tbody>
            <?php $no=1;?>
            @foreach ($recording as $record)
                <tr>
                    <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                    {{ $record->no }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($record->tanggal)->isoFormat('D MMMM Y') }}
                    </td>
                    <td>
                        {{ $record->jenis_pakan }}
                    </td>
                    <td>
                        {{ $record->jumlah_pakan }}
                    </td>
                    <td>
                        {{ $record->pakan_digunakan }}
                    </td>
                    <td>
                        {{ $record->nama_siklus }} - {{ $record->nama_farm }} - {{ $record->nama }}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm my-1" href="/pjub/pakan/{{ $record->pakan_id }}/edit"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm my-1" href="/pjub/pakan/{{ $record->pakan_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            <?php $no++ ;?>
            </tbody>
            </table>
        </div>
      </div>
    </div>
@stop
