@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@if(auth()->user()->isMitra())

@section('content_header')
    <h1 class="m-0 text-dark">Detail Kas</h1>
@stop

@section('content')
<div class="detail-mitra">
    @foreach ($sikluses as $siklus) 
        <a href="/mitra/kas/{{ $siklus->siklus_id }}/tambah" class="btn btn-primary">Tambah Data Kas</a>
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
                            <th class="header-tabel-data text-center" scope="col" >Tanggal</th>
                            <th class="header-tabel-data text-center" scope="col" >Nama</th>
                            <th class="header-tabel-data text-center" scope="col" >Vol</th>
                            <th class="header-tabel-data text-center" scope="col" >Satuan</th>
                            <th class="header-tabel-data text-center" scope="col" >Harga Satuan</th>
                            <th class="header-tabel-data text-center" scope="col" >Kategori</th>
                            <th class="header-tabel-data text-center" scope="col" >Debit</th>
                            <th class="header-tabel-data text-center" scope="col" >Kredit</th>
                            <th class="header-tabel-data text-center" scope="col" >Saldo</th>
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
                                    {{ \Carbon\Carbon::parse($record->tanggal)->isoFormat('D-MMM-Y') }}
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
                                <td class="text-center">
                                    {{ $record->kategori }}
                                </td>
                                <td class="text-right">
                                    {{ number_format($record->pemasukan, 0, ',', '.' ) }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($record->pengeluaran, 0, ',', '.' ) }}
                                </td>
                                <td class="text-right"> 
                                    {{ number_format($record->jml_saldo, 0, ',', '.' ) }}
                                </td>
                                <td class="text">
                                    {{ $record->keterangan }}
                                </td>
                                <td class="text-center">
                                <a class="btn btn-success btn-sm my-1" href="/mitra/kas/{{ $record->id }}/lpj"><i class="fas fa-print"></i></a>
                                <a class="btn btn-info btn-sm my-1" href="/mitra/kas/{{ $record->id }}/edit"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger btn-sm my-1" href="/mitra/kas/{{ $record->id }}/{{ $record->siklus_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>
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
