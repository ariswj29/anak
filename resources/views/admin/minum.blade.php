@extends('adminlte::page')

@section('title', 'Konsumsi Minum | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Minum</h1>
@stop

@section('content')
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif    

    <div class="row justify-content-between mt-2">
        <div class="col-md-2">
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro"; href="/admin/minum/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
                <thead>
                <tr class="thead">
                          <th class="header-tabel-data" scope="col-3" >No.</th>
                          <th class="header-tabel-data" scope="col" >Siklus</th>
                          <th class="header-tabel-data" scope="col" >Jumlah Minum (l)</th>
                          <th class="header-tabel-data" scope="col" >Tanggal</th>
                          <th class="header-tabel-data" scope="col" >Aksi</th>
                </tr>
                </thead>
                <tbody> 
                <?php $no=1;?>
                    @foreach ($minums as $minum)
                    <tr>
                        <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                            
                            {{ $no }}
                        </td>
                        <td>
                            {{ $minum->siklus->nama_siklus }} - {{ $minum->siklus->farm->nama_farm }} - {{ $minum->siklus->farm->mitra->nama }}
                        </td>
                        <td>
                            {{ $minum->jumlah_minum }}
                        </td>
                        <td>
                            {{ $minum->tanggal }}
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm my-1" href="/admin/minum/{{ $minum->minum_id }}/edit"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="/admin/minum/{{ $minum->minum_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>  
                        </td>
                    </tr>
                    <?php $no++ ;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
