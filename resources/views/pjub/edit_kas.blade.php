@extends('adminlte::page')

@section('title', ' Aplikasi Ternak | Edit Data Kas')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Edit Data Kas</h1>
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

    <form action="/pjub/kas/{{ $kases->kas_id }}/update" method="POST">
		@csrf
    <div class="card-body">
      <div class="row"> 
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}">{{ $siklus->nama_siklus == $siklus->siklus_id ? 'selected' : '' }}  
                        {{ $siklus->nama_siklus }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($transaksies as $transaksi)
                    <option value="{{ $transaksi->jenis_transaksi_id }}">{{ $transaksi->jenis_transaksi == $transaksi->jenis_transaksi_id ? 'selected' : '' }}  
                        {{ $transaksi->jenis_transaksi }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleControlInput1" name="tanggal" value="{{ $kases->tanggal }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Uraian</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="uraian" value="{{ $kases->uraian }}" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Volume</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="vol" value="{{ $kases->vol }}">
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Satuan</label>
            <select name="satuan_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($satuanes as $satuan)
                    <option value="{{ $satuan->satuan_id }}">{{ $satuan->satuan == $satuan->satuan_id ? 'selected' : '' }}
                        {{ $satuan->satuan }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Harga Satuan</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="harga_satuan" value="{{ $kases->harga_satuan }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                @foreach ($kategories as $kategori)
                    <option value="{{ $kategori->kategori_id }}">{{ $kategori->kategori == $kategori->kategori_id ? 'selected' : '' }}
                        {{ $kategori->kategori }} 
                    </option>
                @endforeach
            </select>
        </div>
        <!-- <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="jumlah" value="{{ $kases->jumlah }}">
        </div> -->
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
            <input type="textarea" class="form-control" id="exampleFormControlInput1" name="keterangan" value="{{ $kases->keterangan }}" placeholder="Jika perlu isi Keterangan!">
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-success mt-2">Perbarui Data</button>
            <a href="/pjub/kas/{{ $kases->siklus_id }}/detail" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
    @stop