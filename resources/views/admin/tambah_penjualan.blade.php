@extends('adminlte::page')

@section('title', 'Tambah Data Penjualan | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Penjualan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white">
                <div class="card-body">
                    <center><p class="mb-0">Tambah Data Penjualan</p></center>
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

    <form action="/admin/penjualan/store" method="POST" enctype="multipart/form-data">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" placeholder="Masukan Siklus ID"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih Siklus </option>
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus }} - {{ $siklus->farm->nama_farm }} - {{ $siklus->farm->mitra->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" placeholder="Isi Tanggal!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Penjualan</label>
            <div class="input-group">
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah" placeholder="Isi jumlah penjualan!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <div class="input-group-append">
                    <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">ekor</label>
                </div>
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Bobot Jual</label>
            <div class="input-group">
            <input type="number" class="form-control" id="exampleControlInput1" name="bobot_jual" placeholder="Isi bobot penjualan!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <div class="input-group-append">
                    <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">gram</label>
                </div>
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Nominal</label>
            <div class="input-group">
            <div class="input-group-append">
                <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">Rp.</label>
            </div>
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah_nominal" placeholder="Isi jumlah nominal!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Foto</label>
            <input type="file" class="form-control" id="exampleControlInput1" name="foto" placeholder="Jika bisa kirim Foto!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <button class="btn btn-success">Simpan Data</button>
            <a href="/admin/penjualan" class="btn btn-danger ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
