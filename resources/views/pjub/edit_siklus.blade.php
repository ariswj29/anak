@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Edit Data Siklus')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Siklus</h1>
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

    <form action="/pjub/siklus/{{ $sikluses->siklus_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row"> 
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Farm</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="farm_id" value="{{ $sikluses->farm_id }}"> -->
            <select name="farm_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($farms as $farm)
                    <option value="{{ $farm->farm_id }}">{{ $farm->nama_farm == $farm->farm_id ? 'selected' : '' }}  
                        {{ $farm->nama_farm }} - {{ $farm->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Siklus</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nama_siklus" value="{{ $sikluses->nama_siklus }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_mulai" value="{{ $sikluses->tanggal_mulai }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_selesai" value="{{ $sikluses->tanggal_selesai }}">
            <label style="font-size:11px; color:grey;">* Isi jika tau tanggal selesai!</label>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jenis Ternak</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="jenis_ternak" value="{{ $sikluses->jenis_ternak }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Ternak</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah_ternak" value="{{ $sikluses->jumlah_ternak }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Harga Satuan DOC</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="harga_satuan_doc" value="{{ $sikluses->harga_satuan_doc }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Supplier</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="supplier" value="{{ $sikluses->supplier }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <br><button class="btn btn-success mt-2">Perbarui Data</button>
            <a href="/pjub/siklus" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
