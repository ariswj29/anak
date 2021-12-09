@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Edit Data Farm')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Farm</h1>
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

    <form action="/pjub/farm/{{ $farms->farm_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mitra</label>
            <select name="mitra_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($mitras as $mitra)
                    <option value="{{ $mitra->mitra_id }}"> {{ $mitra->nama == $mitra->mitra_id ? 'selected' : '' }} 
                        {{$mitra->nama}}
                    </option>
                @endforeach
            </select>     
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Farm</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nama_farm" value="{{ $farms->nama_farm }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')"> 
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Alamat Farm</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="alamat_farm" value="{{ $farms->alamat_farm }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <!-- <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">No Handphone</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="no_hp" value="{{ $farms->no_hp }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" value="{{ $farms->email }}">
        </div> -->
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mata Uang</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="mata_uang" value="{{ $farms->mata_uang }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Satuan Berat (Kg)</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="satuan_berat" value="{{ $farms->satuan_berat }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kapasitas Rak Telur</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="kapasitas_rak_telur" value="{{ $farms->kapasitas_rak_telur }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kapasitas Kandang Doc</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="kapasitas_kandang_doc" value="{{ $farms->kapasitas_kandang_doc }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kapasitas Kandang Grower</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="kapasitas_kandang_grower" value="{{ $farms->kapasitas_kandang_grower }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-success mt-2">Perbarui Data</button>
            <a href="/pjub/farm" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
