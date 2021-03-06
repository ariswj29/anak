@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Tambah Data Mitra ')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Mitra</h1>
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

    <form action="/admin/mitra/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">    
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">PJUB</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="pjub_id" placeholder="Isi PJUB ID"> -->
            <select name="pjub_id" id="pjub_id" class="form-control" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih PJUB </option>
                @foreach ($pjubs as $pjub)
                    <option value="{{ $pjub->pjub_id }}"> {{ $pjub->nama }} </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nama" placeholder="Isi Nama!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nomor Induk Kependudukan</label>
            <input type="text" class="form-control" maxlength="16" id="exampleControlInput1" name="nik" placeholder="Isi NIK!" pattern="[0-9]{16}" autofocus required oninvalid="setCustomValidity('Tolong Isi 16 digit angka NIK!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="tempat_lahir" placeholder="Isi Tempat Lahir!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" placeholder="Isi Tanggal Lahir!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="alamat" placeholder="Isi Alamat!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">No Handphone</label>
            <input type="text" class="form-control" minlength="11" maxlength="13" id="exampleControlInput1" name="no_hp" placeholder="Isi No Handphone!" pattern="[0-9]{11-13}" autofocus required oninvalid="setCustomValidity('Tolong Isi 11-13 digit angka No Handphone!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" placeholder="Isi Email!" autofocus required oninvalid="setCustomValidity('Tolong Gunakan '@' untuk email!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-success mt-2">Simpan Data</button>
            <a href="/admin/mitra" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
