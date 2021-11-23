@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@if(auth()->user()->isMitra())

@section('content_header')
    <h1 class="m-0 text-dark">Pembelanjaan Modal</h1>
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
                <b>{{ $sum->nama_farm }}</b>
                <br>{{ $sum->alamat_farm }}
            </div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col" style="color:grey">PJUB</div>    
                        <div class="col" style="color:grey">Subtotal Modal</div>
                    </div> 
                    <div class="row">
                        <div class="col"><b>{{ $sum->nama  }}</b></div>  
                        <div class="col"><b>{{ $sum->mata_uang }}. {{ number_format($sum->jml_subtotal, 0, ',', '.') }} </b></div>
                    </div>
                </div>
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
                <center><a href="/mitra/capex/{{ $sum->farm_id }}/detail" class="btn btn-primary">Detail Modal</a></center>
            </div>
        </div>
        @endforeach

    </div>

@stop
    
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
