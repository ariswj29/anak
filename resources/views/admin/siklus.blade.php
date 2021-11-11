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
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro"; href="/admin/siklus/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
                <thead>
                <tr class="thead">
                          <th class="header-tabel-data" scope="col-3" >No.</th>
                          <th class="header-tabel-data" scope="col" >Farm</th>
                          <th class="header-tabel-data" scope="col" >Nama Siklus</th>
                          <th class="header-tabel-data" scope="col" >Tanggal</th>
                          <th class="header-tabel-data" scope="col" >Jenis Ternak</th>
                          <th class="header-tabel-data" scope="col" >Jumlah Ternak</th>
                          <th class="header-tabel-data" scope="col" >Harga Satuan DOC</th>
                          <th class="header-tabel-data" scope="col" >Supplier</th>
                          <th class="header-tabel-data" scope="col" >Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no=1;?>
                    @foreach ($sikluses as $siklus)
                    <tr>
                        <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                            {{ $no }}
                        </td>
                        <td>
                            {{ $siklus->farm->nama_farm }}
                        </td>
                        <td>
                            {{ $siklus->nama_siklus }}
                        </td>
                        <td>
                            {{ $siklus->tanggal }}
                        </td>
                        <td>
                            {{ $siklus->jenis_ternak }}
                        </td>
                        <td>
                            {{ $siklus->jumlah_ternak }}
                        </td>
                        <td>
                            {{ $siklus->harga_satuan_doc }}
                        </td>
                        <td>
                            {{ $siklus->supplier }}
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm my-1" href="/admin/siklus/{{ $siklus->siklus_id }}/edit"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="/admin/siklus/{{ $siklus->siklus_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>  
                        </td>
                    </tr>
                    <?php $no++ ;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>   
@stop