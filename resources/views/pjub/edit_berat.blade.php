@extends('adminlte::page')

@section('title', 'Edit Berat Ayam | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Berat Ayam</h1>
@stop

@section('content')
<div class="row">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:lightblue; color:white;">
                <div class="card-body">
                    <center><p class="mb-0">Edit Data Berat Ayam</p></center>
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

    <form action="/pjub/berat/{{ $berats->berat_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }}
                         {{ $siklus->nama_siklus }} - {{ $siklus->nama_farm }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Rata-rata Berat Ayam (g)</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="rata_rata_berat" value="{{ $berats->rata_rata_berat }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" value="{{ $berats->tanggal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <br><button class="btn btn-success mt-2">Update Data</button>
            <a href="/pjub/berat" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
