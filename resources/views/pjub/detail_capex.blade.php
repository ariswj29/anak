@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@if(auth()->user()->isPjub())

@section('content_header')
    <h1 class="m-0 text-dark">Pembelanjaan Modal</h1>
@stop

@section('content')
<div class="detail-mitra">
    @foreach ($farming as $farm) 
        <a href="/pjub/capex/{{ $farm->farm_id }}/tambah" class="btn btn-primary">Tambah Data Modal</a>
        <p>
        
            <div class="card">
                <div class="card-body">
                <h6>Nama Farm : {{ $farm->nama_farm }}</h6> 
                <!-- <h6 style="text-align:right;margin-top: -35px;">Mitra : {{ $farm->nama }}</h6> -->
                @endforeach 
                <div class="table-responsive-sm">
                    <!-- <h5>Hai</h5> -->
                    <table class="table">
                        <thead>
                            <tr class="thead">
                            <th class="header-tabel-data" scope="col" >No</th>
                            <th class="header-tabel-data text-center" scope="col" >Perlengkapan</th>
                            <th class="header-tabel-data" scope="col" >Jumlah</th>
                            <th class="header-tabel-data" scope="col" >Harga</th>
                            <th class="header-tabel-data" scope="col" >Satuan</th>
                            <th class="header-tabel-data" scope="col" >Subtotal</th>
                            <th class="header-tabel-data text-center" scope="col" >Keterangan</th>
                            <th class="header-tabel-data" scope="col" >Aksi</th>
                        </tr>
                    </thead>
                        <tbody> 
                            @foreach ($recording as $record) 
                            <tr>
                                <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                                    
                                    {{ $record->no }}
                                </td>
                                <td class="text">
                                    {{ $record->capex }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($record->jumlah, 0, ',', '.' ) }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($record->harga, 0, ',', '.' ) }}
                                </td>
                                <td class="text-center">
                                    {{ $record->satuan }}
                                </td>
                                <td class="text-right"> 
                                    {{ number_format($record->subtotal, 0, ',', '.' ) }}
                                </td>
                                <td class="text">
                                    {{ $record->keterangan }}
                                </td>
                                <td class="text-center">
                                <a class="btn btn-info btn-sm my-1" href="/pjub/capex/{{ $record->capex_id }}/edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm my-1" href="/pjub/capex/{{ $record->capex_id }}/{{ $record->farm_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    

</div>
@stop
    
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
