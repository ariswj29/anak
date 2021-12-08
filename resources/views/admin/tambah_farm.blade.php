@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Tambah Data Farm ')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Farm</h1>
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

    <form action="/admin/farm/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row"> 
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mitra</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="mitra_id" placeholder="Isi Mitra ID"> -->
            <select name="mitra_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih Mitra </option>
                @foreach ($mitras as $mitra)
                    <option value="{{ $mitra->mitra_id }}"> {{ $mitra->nama }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama Farm</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nama_farm" placeholder="Isi Nama Farm!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Alamat Farm</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="alamat_farm" placeholder="Isi Alamat Farm!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <!-- <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">No Handphone</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="no_hp" placeholder="Isi No Handphone">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" placeholder="Isi Email">
        </div> -->
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Mata Uang</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="mata_uang" placeholder="Isi Mata Uang!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Satuan Berat (Kg)</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="satuan_berat" placeholder="Isi Satuan Berat!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">kapasitas Rak Telur</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="kapasitas_rak_telur" placeholder="Isi kapasitas Rak Telur!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kapasitas Kandang Doc</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="kapasitas_kandang_doc" placeholder="Isi Kapasitas Kandang Doc!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kapasitas Kandang Grower</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="kapasitas_kandang_grower" placeholder="Isi Kapasitas Kandang Grower" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-success mt-2">Simpan Data</button>
            <a href="/admin/farm" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
    @stop
    