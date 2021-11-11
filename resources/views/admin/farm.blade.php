@extends('adminlte::page')

@section('title', 'Farm | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Farm</h1>
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
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro;" href="/admin/farm/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
                <thead>
                <tr class="thead">
                          <th class="header-tabel-data" scope="col-3">No.</th>
                          <th class="header-tabel-data" scope="col">Mitra</th>
                          <th class="header-tabel-data" scope="col">Nama Farm</th>
                          <th class="header-tabel-data" scope="col">Alamat Farm</th>
                          <!-- <th class="header-tabel-data" scope="col">No Handphone</th>
                          <th class="header-tabel-data" scope="col">Email</th> -->
                          <th class="header-tabel-data" scope="col">Mata Uang</th>
                          <th class="header-tabel-data" scope="col">Satuan Berat</th>
                          <th class="header-tabel-data" scope="col">Kapasitas Rak Telur</th>
                          <th class="header-tabel-data" scope="col">Kapasitas Kandang DOC</th>
                          <th class="header-tabel-data" scope="col">Kapasitas Kandang Grower</th>
                          <th class="header-tabel-data" scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no=1;?>
                    @foreach ($farms as $farm)
                    <tr>
                        <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                            {{ $no }}
                        </td>
                        <td>
                            {{ $farm->nama }}
                        </td>
                        <td>
                            {{ $farm->nama_farm }}
                        </td>
                        <td>
                            {{ $farm->alamat_farm }}
                        </td>
                        <td>
                            {{ $farm->mata_uang }}
                        </td>
                        <td>
                            {{ $farm->satuan_berat }}
                        </td>
                        <td>
                            {{ $farm->kapasitas_rak_telur }}
                        </td>
                        <td>
                            {{ $farm->kapasitas_kandang_doc }}
                        </td>
                        <td>
                            {{ $farm->kapasitas_kandang_grower }}
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm my-1" href="/admin/farm/{{ $farm->farm_id }}/edit"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="/admin/farm/{{ $farm->farm_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>  
                        </td>
                    </tr>
                    <?php $no++ ;?>
                    @endforeach
                </tbody>                 
            </table>
        </div>
    </div>
@stop
