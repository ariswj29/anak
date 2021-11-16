@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@if(auth()->user()->isPjub())

@section('content_header')
    <h1 class="m-0 text-dark">Dasbor</h1>
@stop

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif    

    <div class="home-mitra">
        <!-- <a href="" class="btn btn-outline-primary"></a>
        <button type="button" class="btn btn-outline-success">Success</button>
        <button type="button" class="btn btn-outline-danger">Danger</button>
        <button type="button" class="btn btn-outline-warning">Warning</button> -->

        @foreach($summary as $sum)
        <div class="card">
            <div class="card-header">
                <b>{{ $sum->nama_siklus }}</b>
                <div class="jdlskls"><b>{{ $sum->nama_farm }}</b></div>
                {{ $sum->alamat_farm }}
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="color:grey">PJUB</div>  
                        <div class="col" style="color:grey">Rata-Rata Berat Ternak</div>  
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
                </div>
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <center><a href="/pjub/{{ $sum->siklus_id }}/detail" class="btn btn-primary">Detail dan Update</a></center>
            </div>
        </div>
        @endforeach

    </div>

@stop
    
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
