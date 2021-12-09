@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Edit Data Konsumsi Pakan')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Konsumsi Pakan</h1>
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

    <form action="/pjub/pakan/{{ $pakans->pakan_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">  
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus ID</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" value="{{ $pakans->siklus_id }}"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}">{{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }}  
                         {{ $siklus->nama_siklus }} - {{ $siklus->nama_farm }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jenis Pakan</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="jenis_pakan" value="{{ $pakans->jenis_pakan }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Pakan (g)</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah_pakan" value="{{ $pakans->jumlah_pakan }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Pakan yang digunakan (g)</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="pakan_digunakan" value="{{ $pakans->pakan_digunakan }}" placeholder="Isi jika pakan sudah dipakai!">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" value="{{ $pakans->tanggal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <br><button class="btn btn-success mt-2">Update Data</button>
            <a href="/pjub/pakan" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
