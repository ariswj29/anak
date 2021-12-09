@extends('adminlte::page')

@section('title', ' Aplikasi Ternak | Edit Data Penjualan ')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Penjualan</h1>
@stop

@section('content')

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

    <form action="/mitra/penjualan/{{ $penjualans->penjualan_id }}/update" method="POST" enctype="multipart/form-data">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" placeholder="Masukan Siklus ID"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }} 
                        {{ $siklus->nama_siklus }} - {{ $siklus->nama_farm }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" value="{{ $penjualans->tanggal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Penjualan</label>
            <div class="input-group">
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah" value="{{ $penjualans->jumlah }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <div class="input-group-append">
                    <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">ekor</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Bobot Jual</label>
            <div class="input-group">
            <input type="number" class="form-control" id="exampleControlInput1" name="bobot_jual" value="{{ $penjualans->bobot_jual }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <div class="input-group-append">
                    <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">gram</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Nominal</label>
            <div class="input-group">
            <div class="input-group-append">
                <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">Rp.</label>
            </div>
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah_nominal" value="{{ $penjualans->jumlah_nominal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            </div>
        </div>
        <!-- <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Foto</label>
            <br><img src="{{ asset('images/'.$penjualans->foto) }}" style="width: 100px; height: 100px;" alt="">
        </div> -->
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ganti Foto</label>
            <input type="file" class="form-control"name="foto" value="{{ $penjualans->foto }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            <!-- <label style="font-size:12px;">*) Jika foto tidak diganti, kosongkan saja.</label> -->
        </div>
        <div class="col-md-6">
            <button class="btn btn-success my-1">Perbarui Data</button>
            <a href="/admin/penjualan" class="btn btn-danger my-1 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
