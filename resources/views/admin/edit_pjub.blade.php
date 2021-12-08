@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Edit Data PJUB ')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data PJUB</h1>
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

    <form action="/admin/pjub/{{ $pjubs->pjub_id }}/update" method="POST">
		@csrf
    <div class="card-body">
     <div class="row">
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nama" value="{{ $pjubs->nama }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')"> 
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nomor Induk Kependudukan</label>
            <input type="text" class="form-control" maxlength="16" id="exampleControlInput1" name="nik" pattern="[0-9]{16}" autofocus required oninvalid="setCustomValidity('Tolong masukan 16 digit angka NIK!')" onchange="try{setCustomValidity('')}catch(e){}" value="{{ $pjubs->nik }}"  /> 
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="tempat_lahir" value="{{ $pjubs->tempat_lahir }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" value="{{ $pjubs->tanggal_lahir }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="alamat" value="{{ $pjubs->alamat }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">No Handphone</label>
            <input type="text" class="form-control" minlength="11" maxlength="13" id="exampleControlInput1" name="no_hp" value="{{ $pjubs->no_hp }}" pattern="[0-9]{11-13}" autofocus required oninvalid="setCustomValidity('Tolong masukan 11-13 digit angka No Handphone!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" value="{{ $pjubs->email }}" autofocus required oninvalid="setCustomValidity('Tolong Gunakan '@' untuk email!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-success mt-2">Update Data</button>
            <a href="/admin/pjub" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
