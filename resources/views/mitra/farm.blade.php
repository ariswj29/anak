@extends('adminlte::page')

@section('title', 'Farm | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
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

    <!-- <div class="row justify-content-between mt-2">
        <div class="col-md-2">
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro;" href="/mitra/farm/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div> -->

    <div class="table-responsive">
    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr class="thead">
                    <th class="header-tabel-data" scope="col">No.</th>
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
                    <!-- <th class="header-tabel-data" scope="col">Aksi</th> -->
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
                    <td class="">
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
                    <!-- <td class="">
                        <a class="btn btn-info btn-sm my-1" href="/mitra/farm/{{ $record->farm_id }}/edit"><i class="fas fa-edit"></i></a>
                    </td> -->
                </tr>
            @endforeach
                            
            </tbody>
        </table>
    </div>

@stop
