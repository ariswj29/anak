@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Tambah Data Manajemen User ')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data User</h1>
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

    <form action="/admin/user/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row g-3">    
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="name" placeholder="Isi Nama!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Hak Akses</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="pjub_id" placeholder="Isi PJUB ID"> -->
            <select name="hak_akses" id="hak_akses" class="form-control" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih PJUB </option>
                <option value="pjub" id="pjub"> PJUB </option>
                <option value="mitra" id="mitra"> Mitra </option>
            </select>
        </div>    
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" placeholder="Isi Email!" autofocus required oninvalid="setCustomValidity('Tolong Gunakan '@' untuk email')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="password" placeholder="Isi Password!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-success mt-2">Simpan Data</button>
            <a href="/admin/mitra" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
