@extends('adminlte::page')

@section('title', 'Edit Data Penjualan | Aplikasi Ternak')

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
                    <center><p class="mb-0">Edit Data Penjualan</p></center>
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

    <form action="/admin/penjualan/{{ $penjualans->penjualan_id }}/update" method="POST" enctype="multipart/form-data">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" placeholder="Masukan Siklus ID"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }} 
                        {{ $siklus->nama_siklus }} - {{ $siklus->farm->nama_farm }} - {{ $siklus->farm->mitra->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" value="{{ $penjualans->tanggal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Penjualan</label>
            <div class="input-group">
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah" value="{{ $penjualans->jumlah }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <div class="input-group-append">
                    <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">ekor</label>
                </div>
            </div>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Bobot Jual</label>
            <div class="input-group">
            <input type="number" class="form-control" id="exampleControlInput1" name="bobot_jual" value="{{ $penjualans->bobot_jual }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
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
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah_nominal" value="{{ $penjualans->jumlah_nominal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            </div>
        </div>
        <!-- <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Foto</label>
            <br><img src="{{ asset('images/'.$penjualans->foto) }}" style="width: 100px; height: 100px;" alt="">
        </div> -->
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Ganti Foto</label>
            <input type="file" class="form-control"name="foto" value="{{ $penjualans->foto }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            <label style="font-size:12px;">*) Jika foto tidak diganti, kosongkan saja.</label>
        </div>
        <div class="col-6" style="margin-top:-40px;">
            <button class="btn btn-success my-1">Perbarui Data</button>
            <a href="/admin/penjualan" class="btn btn-danger my-1 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
