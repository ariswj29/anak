@extends('adminlte::page')

@section('title', 'Edit User | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">User</h1>
@stop

@section('content')
<div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff; color:white;">
                <div class="card-body">
                    <center><p class="mb-0">Edit Data User</p></center>
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

    <form action="/admin/user/{{ $users->id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row">  
        <div class="col-6 mb-3">
              <label for="exampleFormControlInput1" class="form-label">Nama</label>
              <input type="text" class="form-control" id="exampleControlInput1" name="name" value="{{ $users->name }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')"> 
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Hak Akses</label>
            <select name="hak_akses" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <option value="" selected disabled>Pilih PJUB </option>
                <option value="pjub" id="pjub"> PJUB </option>
                <option value="mitra" id="mitra"> Mitra </option>
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email</label>
            <input type="email" class="form-control" id="exampleControlInput1" name="email" value="{{ $users->email }}" autofocus required oninvalid="setCustomValidity('Tolong gunakan '@' untuk email!')" onchange="try{setCustomValidity('')}catch(e){}"/>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Password</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="password" value="" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <button class="btn btn-success mt-2" data-toggle="modal" data-target=".bs-example-modal-sm">Update Data</button>
            <a href="/admin/user" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
    </form>
@stop
