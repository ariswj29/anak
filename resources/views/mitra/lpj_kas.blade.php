@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@if(auth()->user()->isMitra())

@section('content_header')
    <h1 class="m-0 text-dark">Laporan Penanggung Jawaban</h1>
    @stop
    
@section('content')
<div class="lpj-mitra">
    
    <h6 class="text-dark">I. Pengeluaran</h6>
    <h6 class="jdlskls text-dark">Tanggal Mulai :</h6>
    @foreach ($sikluses as $siklus) 
        <p>
        
            <div class="card">
                <div class="card-body">
                <h6>Kode : {{ $siklus->kode }}</h6> 
                <!-- <h6>Nama Farm : {{ $siklus->nama_farm }}</h6> -->
                @endforeach
                <div class="table-responsive-md">
                    <!-- <h5>Hai</h5> -->
                    <table class="table">
                        <thead>
                        <tr class="thead">
                            <th class="header-tabel-data" scope="col" >No</th>
                            <th class="header-tabel-data text-center" scope="col" >Uraian</th>
                            <th class="header-tabel-data text-center" scope="col" >Vol</th>
                            <th class="header-tabel-data text-center" scope="col" >Satuan</th>
                            <th class="header-tabel-data text-center" scope="col" >Jumlah</th>
                            <th class="header-tabel-data text-center" scope="col" >Rerata</th>
                            <th class="header-tabel-data text-center" scope="col" >Ket</th>
                            <th class="header-tabel-data" scope="col" >Aksi</th>
                        </tr>
                    </thead>
                    <tbody> 
                        
                        @foreach ($recording as $record) 
                            <tr>
                                <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                                    {{ $record->no }}
                                </td>
                                <td class="text-">
                                    {{ $record->tanggal }}
                                </td>
                                <td class="text-">
                                    {{ $record->nama }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($record->vol, 0, ',', '.' ) }}
                                </td>
                                <td class="text-center">
                                    {{ $record->satuan }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($record->harga_satuan, 0, ',', '.' ) }}
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
