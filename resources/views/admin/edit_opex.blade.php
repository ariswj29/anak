@extends('adminlte::page')

@section('title', 'Edit Data Operasional | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Operasional</h1>
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

    <form action="/admin/opex/{{ $opexs->opex_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row"> 
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}">{{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }}  
                        {{ $siklus->nama_siklus }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Perlengkapan</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="opex" value="{{ $opexs->opex }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="jumlah" value="{{ $opexs->jumlah }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Harga</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="harga" value="{{ $opexs->harga }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="satuan" value="{{ $opexs->satuan }}">
        </div>
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="keterangan" value="{{ $opexs->keterangan }}">
        </div>
        <div class="col-6 mb-3">
            <button class="btn btn-success mt-2">Perbarui Data</button>
            <a href="/admin/opex/{{ $opexs->siklus_id }}/detail" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
    @stop
    