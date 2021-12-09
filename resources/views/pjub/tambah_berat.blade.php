@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Tambah Data Bobot Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Bobot Ternak</h1>
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

    <form action="/pjub/berat/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih Siklus </option>
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus }} - {{ $siklus->nama_farm }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Rata-rata Bobot Ternak (g)</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="rata_rata_berat" placeholder="Isi Rata-rata Bobot ternak!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" placeholder="Isi Tanggal!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <br><button class="btn btn-success mt-2">Simpan Data</button>
            <a href="/pjub/berat" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
