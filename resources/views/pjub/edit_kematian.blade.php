@extends('adminlte::page')

@section('title', 'Edit Kematian | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Kematian</h1>
@stop

@section('content')
    <div class="row">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white;">
                <div class="card-body">
                    <center><p class="mb-0">Edit Data Kematian</p></center>
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

    <form action="/pjub/kematian/{{ $kematians->kematian_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus ID</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" value="{{ $kematians->siklus_id }}"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }} 
                        {{ $siklus->nama_siklus }} - {{ $siklus->nama_farm }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" value="{{ $kematians->tanggal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Kematian</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah_kematian" value="{{ $kematians->jumlah_kematian }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-12 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Penyebab</label>
            <textarea class="form-control" id="exampleControlInput1" placeholder="Isi jika ada kematian!" name="penyebab">{{ $kematians->penyebab }}</textarea>
        </div>
        <div class="col-6 mb-3">
            <p><button class="btn btn-success">Update Data</button>
            <a href="/pjub/kematian" class="btn btn-danger ml-2">Kembali</a>
        </div>
	</form>
@stop
