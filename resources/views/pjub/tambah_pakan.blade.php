@extends('adminlte::page')

@section('title', 'Tambah Data Konsumsi Pakan | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Pakan</h1>
@stop

@section('content')
    <div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white;">
                <div class="card-body">
                    <center><p class="mb-0">Tambah Data Konsumsi Pakan</p></center>
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

    <form action="/mitra/pakan/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row"> 
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus ID</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" placeholder="Isi Siklus ID"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih Siklus </option>
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus }} - {{ $siklus->nama_farm }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jenis Pakan</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="jenis_pakan" placeholder="Isi Jenis Pakan" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Stok Pakan (g)</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="jumlah_pakan" placeholder="Isi Jumlah Pakan" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            </input>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Pakan Yang Digunakan (g)</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="pakan_digunakan" placeholder="Isi Pakan yang digunakan!">
            </input>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" placeholder="Isi Tanggal" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <br><button class="btn btn-success mt-2">Tambah Data</button>
            <a href="/mitra/pakan" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
