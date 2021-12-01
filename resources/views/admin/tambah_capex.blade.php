@extends('adminlte::page')

@section('title', 'Tambah Data Modal | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Modal</h1>
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

    <form action="/admin/capex/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row"> 
        <div class="col-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Farm</label>
            <select name="farm_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->farm_id }}">{{ $siklus->nama_farm == $siklus->farm_id ? 'selected' : '' }}  
                        {{ $siklus->nama_farm }} 
                    </option>
                </select>
            </div>
            <div class="col-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Perlengkapan</label>
                <input type="text" class="form-control" id="exampleControlInput1" name="capex" placeholder="Isi Perlengkapan!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            </div>
            <div class="col-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="exampleControlInput1" name="jumlah" placeholder="Isi Jumlah Perlengkapan!">
            </div>
            <div class="col-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Harga</label>
                <input type="number" class="form-control" id="exampleFormControlInput1" name="harga" placeholder="Isi Harga Perlengkapan">
            </div>
            <div class="col-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="satuan" placeholder="Isi Satuan Perlengkapan">
            </div>
            <div class="col-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="keterangan" placeholder="Isi Keterangan">
            </div>
            <div class="col-6 mb-3">
                <button class="btn btn-success mt-2">Simpan Data</button>
                <a href="/admin/capex/{{ $siklus->farm_id }}/detail" class="btn btn-danger mt-2 ml-2">Kembali</a>
                @endforeach
        </div>
      </div>
    </div>
	</form>
    @stop
    