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
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro;" href="/pjub/farm/tambah" data-toggle="tooltip" data-placement="bottom" title="Isi ketika ingin menambah farm baru"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="table-responsive">
    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr class="thead">
                    <th class="header-tabel-data" scope="col">No.</th>
                    <th class="header-tabel-data" scope="col">Mitra</th>
                    <th class="header-tabel-data" scope="col">Nama Farm</th>
                    <th class="header-tabel-data" scope="col-3">Alamat Farm</th>
                    <!-- <th class="header-tabel-data" scope="col">No Handphone</th>
                    <th class="header-tabel-data" scope="col">Email</th> -->
                    <th class="header-tabel-data" scope="col">Mata Uang</th>
                    <th class="header-tabel-data" scope="col">Satuan Berat</th>
                    <th class="header-tabel-data" scope="col">Kapasitas Rak Telur</th>
                    <th class="header-tabel-data" scope="col">Kapasitas Kandang DOC (Anak Ayam)</th>
                    <th class="header-tabel-data" scope="col">Kapasitas Kandang Grower (Pembesaran)</th>
                    <th class="header-tabel-data">Aksi</th>
                </tr>
            </thead>
            <tbody> 
            @foreach ($recording as $record)
                <tr>
                    <td class=" text-center whitespace-nowrap">
                        {{ $record->no }}
                    </td>
                    <td class="">
                        {{ $record->nama }}
                    </td>
                    <td class="">
                        {{ $record->nama_farm }}
                    </td>
                    <td class="" scope="col-3">
                        {{ $record->alamat_farm }}
                    </td>
                    <td class="">
                        {{ $record->mata_uang }}
                    </td>
                    <td class="">
                        {{ $record->satuan_berat }}
                    </td>
                    <td class="">
                        {{ $record->kapasitas_rak_telur }}
                    </td>
                    <td class="">
                        {{ $record->kapasitas_kandang_doc }}
                    </td>
                    <td class="">
                        {{ $record->kapasitas_kandang_grower }}
                    </td>
                    <td class="">
                        <a class="btn btn-info btn-sm my-1" href="/pjub/farm/{{ $record->farm_id }}/edit" data-toggle="tooltip" data-placement="bottom" title="Isi ketika ingin mengubah data farm"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm my-1" href="/pjub/farm/{{ $record->farm_id }}/delete" data-toggle="tooltip" data-placement="bottom" title="Isi ketika ingin menghapus data mitra"onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
                            
            </tbody>
        </table>
    </div>

@stop
