@extends('adminlte::page')

@section('title', 'Edit Konsumsi Minum | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Minum</h1>
@stop

@section('content')
    <div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white">
                <div class="card-body">
                    <center><p class="mb-0">Edit Data Konsumsi Minum</p></center>
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

    <form action="/pjub/minum/{{ $minums->minum_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" value="{{ $minums->siklus_id }}"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }}  
                         {{ $siklus->nama_siklus }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Minum (l)</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah_minum" value="{{ $minums->jumlah_minum }}" pattern="[0-9-,]{5}" autofocus required oninvalid="setCustomValidity('Tolong Isi dengan angka untuk jumlah air minum!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" value="{{ $minums->tanggal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <br><button class="btn btn-success mt-2">Update Data</button>
            <a href="/pjub/minum" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
