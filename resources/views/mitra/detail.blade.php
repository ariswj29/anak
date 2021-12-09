@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@if(auth()->user()->isMitra())

@section('content_header')
    <h1 class="m-0 text-dark">Detail Data Harian</h1>
@stop

@section('content')
<div class="detail-mitra">
        <div class="card">
            <div class="card-header">
                <b>{{ $siklus->nama_siklus }}</b>
                <div class="jdlskls"><b>{{ $siklus->farm->nama_farm }}</b></div>
                {{ $siklus->farm->alamat_farm }}
            </div>
            <div class="card-body">
                <div class="container">
                @foreach($summary as $sum)
                    <div class="row">
                        <div class="col" style="color:grey">PJUB</div>  
                        <div class="col" style="color:grey">Rata-Rata Bobot Ternak</div>  
                        <div class="col" style="color:grey">Jenis Ternak</div>
                    </div> 
                    <div class="row">
                        <div class="col"><b>{{ $sum->pjub  }}</b></div>
                        <div class="col"><b>{{ number_format($sum->jml_rata, 0, ',', '.') }} g </b></div>
                        <div class="col"> <b>{{ $sum->jenis_ternak }}</b></div>  
                    </div> <p>
                    <div class="row">                               
                        <div class="col" style="color:grey">Jumlah Ternak</div>
                        <div class="col" style="color:grey">Kematian</div>
                        <div class="col" style="color:grey">Ternak yang Tersisa</div>
                    </div>
                    <div class="row">
                        <div class="col"> <b>{{ $sum->jumlah_ternak }}</b></div>
                        <div class="col"> <b>{{ number_format($sum->jml_kematian, 0, ',', '.' ) }}</b></div>
                        <div class="col"> <b>{{ $sum->jumlah_ternak - $sum->jml_kematian }}</b></div>                    
                    </div> <p>
                    <div class="row">
                        <div class="col" style="color:grey">Jumlah Stok Pakan</div>             
                        <div class="col" style="color:grey">Pakan yang Dikonsumsi</div>
                        <div class="col" style="color:grey">Pakan yang Tersisa</div>
                    </div>
                    <div class="row">
                        <div class="col"> <b> {{ number_format($sum->jml_pakan, 0, ',', '.' ) }} g</b></div>               
                        <div class="col"> <b> {{ number_format($sum->jml_pakan_digunakan, 0, ',', '.') }} g </b></div>
                        <div class="col"> <b> {{ number_format($sum->jml_pakan - $sum->jml_pakan_digunakan, 0, ',', '.') }} g </b></div>
                    </div>
                @endforeach
                </div>
            </div>

        </div>
        
        <a href="/mitra/perbarui" class="btn btn-primary">Input Data Harian</a>
        <p>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead>
                        <tr class="thead">
                            <th class="header-tabel-data" scope="col" >Hari Ke</th>
                            <th class="header-tabel-data" scope="col" >Tanggal</th>
                            <th class="header-tabel-data" scope="col" >Rata-rata Bobot Ternak (g)</th>
                            <th class="header-tabel-data" scope="col" >Tambah Stok Pakan (g)</th>
                            <th class="header-tabel-data" scope="col" >Pakan yang Digunakan (g)</th>
                            <th class="header-tabel-data" scope="col" >Jumlah Minum (l)</th>
                            <th class="header-tabel-data" scope="col" >Kematian</th>
                        </tr>
                        </thead>
                        <tbody> 
                            @foreach ($recording as $record) 
                            <tr>
                                <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                                    
                                    {{ $record->hari_ke }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($record->tanggal)->isoFormat('dddd, D MMMM Y') }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($record->rata_rata_berat, 0, ',', '.' ) }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($record->jumlah_pakan, 0, ',', '.' ) }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($record->pakan_digunakan, 0, ',', '.' ) }}
                                </td>
                                <td class="text-center"> 
                                    {{ number_format($record->jumlah_minum, 0, ',', '.' ) }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($record->jumlah_kematian, 0, ',', '.' ) }}
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <p>
        <div class="card">
            <div class="card-header text-center">
                <b>Data Awal</b>
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col">Tanggal Mulai</div>
                        <div class="col-1">:</div>
                        <div class="col"><b>{{ \Carbon\Carbon::parse($siklus->tanggal)->isoFormat(' D MMMM Y') }}</b></div>
                    </div>
                    <div class="row">
                        <div class="col">Jumlah Ternak</div>
                        <div class="col-1">:</div>
                        <div class="col"><b>{{ $siklus->jumlah_ternak }}</b></div>
                    </div>
                    <div class="row">
                        <div class="col">Harga Satuan Ayam</div>
                        <div class="col-1">:</div>
                        <div class="col"><b>{{ $siklus->farm->mata_uang }}. {{ number_format($siklus->harga_satuan_doc, 0, ',', '.' ) }}</b></div>
                    </div>
                    <div class="row">
                        <div class="col">Kapasitas Kandang DOC</div>
                        <div class="col-1">:</div>
                        <div class="col"><b>{{ $siklus->farm->kapasitas_kandang_doc }}</b></div>
                    </div>
                    <div class="row">
                        <div class="col">Kapasitas Kandang Grower</div>
                        <div class="col-1">:</div>
                        <div class="col"><b>{{ $siklus->farm->kapasitas_kandang_grower }}</b></div>
                    </div>
                    <div class="row">
                        <div class="col">Kapasitas Rak Telur</div>
                        <div class="col-1">:</div>
                        <div class="col"><b>{{ $siklus->farm->kapasitas_rak_telur }}</b></div>
                    </div>
                </div>
            </div>
        </div>

</div>
@stop
    
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
