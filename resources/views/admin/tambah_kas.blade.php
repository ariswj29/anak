@extends('adminlte::page')

@section('title', 'Tambah Data Kas | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Buku Kas</h1>
@stop

@section('content')
    <div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff;">
                <div class="card-body">
                    <center><p class="mb-0">Tambah Data Buku Kas</p></center>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                    <li class="list-group-item-sm">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/admin/kas/store" method="POST">
	@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kas ID</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="kas_id" placeholder="Masukan Kas ID">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" placeholder="Masukan Siklus ID"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1">
                <option value="" selected disabled>Pilih Siklus </option>
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" placeholder="Masukan Tanggal">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jenis Transaksi</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="jenis_transaksi" placeholder="Masukan Jenis Transaksi">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="kategori" placeholder="Masukan Kategori">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nominal</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="nominal" placeholder="Masukan Nominal">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Catatan</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="catatan" placeholder="Masukan Catatan">
        </div>
        <div class="col-6 mb-3">
            <br><button class="btn btn-success mt-2">Tambah Data</button>
            <a href="/admin/kas" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
