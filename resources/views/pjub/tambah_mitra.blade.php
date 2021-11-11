@extends('adminlte::page')

@section('title', 'Tambah Data Mitra | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mitra</h1>
@stop

@section('content')
    <div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white;">
                <div class="card-body">
                    <center><p class="mb-0">Tambah Data Mitra</p></center>
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

    <form action="/pjub/mitra/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">   
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nama" placeholder="Isi Nama!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nomor Induk Kependudukan</label>
            <input type="text" class="form-control" maxlength="16" id="exampleControlInput1" name="nik" placeholder="Isi NIK!" pattern="[0-9]{16}" autofocus required oninvalid="setCustomValidity('Tolong Isi 16 digit angka NIK!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="tempat_lahir" placeholder="Isi Tempat Lahir!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" placeholder="Isi Tanggal Lahir!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="alamat" placeholder="Isi Alamat!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">No Handphone</label>
            <input type="text" class="form-control" minlength="11" maxlength="13" id="exampleControlInput1" name="no_hp" placeholder="Isi No Handphone!" pattern="[0-9]{11-13}" autofocus required oninvalid="setCustomValidity('Tolong Isi 11-13 digit angka No Handphone!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" placeholder="Isi Email!" autofocus required oninvalid="setCustomValidity('Tolong Gunakan '@' untuk email!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <br><button class="btn btn-success mt-2">Tambah Data</button>
            <a href="/admin/mitra" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
