@extends('adminlte::page')

@section('title', 'Tambah Data User | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">User</h1>
@stop

@section('content')
    <div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white">
                <div class="card-body">
                    <center><p class="mb-0">Tambah Data User</p></center>
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

    <form action="/admin/user/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">    
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="name" placeholder="Isi Nama!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Hak Akses</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="pjub_id" placeholder="Isi PJUB ID"> -->
            <select name="hak_akses" id="hak_akses" class="form-control" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih PJUB </option>
                <option value="pjub" id="pjub"> PJUB </option>
                <option value="mitra" id="mitra"> Mitra </option>
            </select>
        </div>    
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" placeholder="Isi Email!" autofocus required oninvalid="setCustomValidity('Tolong Gunakan '@' untuk email')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="password" placeholder="Isi Password!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <button class="btn btn-success mt-2">Tambah Data</button>
            <a href="/admin/mitra" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
