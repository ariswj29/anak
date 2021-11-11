@extends('adminlte::page')

@section('title', 'PJUB | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">PJUB</h1>
@stop

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success alery-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif    

    <div class="row justify-content-between mt-2">
        <div class="col-md-2">
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro"; href="/admin/pjub/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
                <thead>
                <tr class="thead">
                          <th class="header-tabel-data" scope="col-3" >No.</th>
                          <th class="header-tabel-data" scope="col" >Nama</th>
                          <th class="header-tabel-data" scope="col" >NIK</th>
                          <th class="header-tabel-data" scope="col" >Tempat Lahir</th>
                          <th class="header-tabel-data" scope="col" >Tanggal Lahir</th>
                          <th class="header-tabel-data" scope="col" >Alamat</th>
                          <th class="header-tabel-data" scope="col" >No HP</th>
                          <th class="header-tabel-data" scope="col" >Email</th>
                          <th class="header-tabel-data" scope="col" >Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no=1;?>
                    @foreach ($pjubs as $pjub)
                    <tr>
                        <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                            
                            {{ $no }}
                        </td>
                        <td>
                            {{ $pjub->nama }}
                        </td>
                        <td>
                            {{ $pjub->nik }}
                        </td>
                        <td>
                            {{ $pjub->tempat_lahir }}
                        </td>
                        <td>
                            {{ $pjub->tanggal_lahir }}
                        </td>
                        <td>
                            {{ $pjub->alamat }}
                        </td>
                        <td>
                            {{ $pjub->no_hp }}
                        </td>
                        <td>
                            {{ $pjub->email }}
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm my-1" href="/admin/pjub/{{ $pjub->pjub_id }}/edit"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="/admin/pjub/{{ $pjub->pjub_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>  
                        </td>
                    </tr>
                    <?php $no++ ;?>
                    @endforeach
                    </tbody>
            </table>
        </div>
    </div>
@stop
