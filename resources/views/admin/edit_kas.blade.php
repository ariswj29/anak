@extends('adminlte::page')

@section('title', 'Edit Kas | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Buku Kas</h1>
@stop

@section('content')
    <div class="row ">
        <div class="col offset-md-4">
            <div class="card w-50" style="background-color:#007bff;">
                <div class="card-body">
                    <center><p class="mb-0">Edit Data Buku Kas</p></center>
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

    <form action="/admin/kas/{{ $kas->kas_id }}/update" method="POST">
	@csrf
    <div class="card-body">
      <div class="row">
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kas ID</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="kas_id" value="{{ $kas->kas_id }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <!-- <input type="number" class="form-control" id="exampleControlInput1" name="siklus_id" value="{{ $kas->siklus_id }}"> -->
            <select name="siklus_id" class="form-control" id="exampleControlInput1">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }} 
                        {{ $siklus->nama_siklus }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggal" value="{{ $kas->tanggal }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jenis Transaksi</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="jenis_transaksi" value="{{ $kas->jenis_transaksi }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="kategori" value="{{ $kas->kategori }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Nominal</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="nominal" value="{{ $kas->nominal }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Catatan</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="catatan" value="{{ $kas->catatan }}">
        </div>
        <div class="col-6 mb-3">
            <br><button class="btn btn-success mt-2" >Update Data</button>
            <a href="/admin/kas" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
@stop
