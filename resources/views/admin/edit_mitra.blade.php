@extends('adminlte::page')

@section('title', 'Edit Mitra | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mitra</h1>
@stop

@section('content')
<div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white;">
                <div class="card-body">
                    <center><p class="mb-0">Edit Data Mitra</p></center>
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

    <form action="/admin/mitra/{{ $mitras->mitra_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">  
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">PJUB</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="pjub_id" value="{{ $mitras->pjub_id }}"> --> 
            <select name="pjub_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($pjubs as $pjub)
                    <option value="{{$pjub->pjub_id}}" {{ $mitras->pjub_id == $pjub->pjub_id ? 'selected' : ''  }}>
                        {{$pjub->nama}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nama</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nama" value="{{ $mitras->nama }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')"> 
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nomor Induk Kependudukan</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="nik" value="{{ $mitras->nik }}" maxlength="16" pattern="[0-9]{16}" autofocus required oninvalid="setCustomValidity('Tolong masukan 16 digit angka NIK!')" onchange="try{setCustomValidity('')}catch(e){}"/> 
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="tempat_lahir" value="{{ $mitras->tempat_lahir }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal_lahir" value="{{ $mitras->tanggal_lahir }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="alamat" value="{{ $mitras->alamat }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">No Handphone</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="no_hp" value="{{ $mitras->no_hp }}" minlength="11" maxlength="13" pattern="[0-9]{11-13}" autofocus required oninvalid="setCustomValidity('Tolong masukan 11-13 digit angka No Handphone!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" value="{{ $mitras->email }}" autofocus required oninvalid="setCustomValidity('Tolong gunakan '@' untuk email!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <button class="btn btn-success mt-2" data-toggle="modal" data-target=".bs-example-modal-sm">Update Data</button>
            <a href="/admin/mitra" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
    </form>
@stop
