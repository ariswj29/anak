@extends('adminlte::page')

@section('title', '  Aplikasi Ternak | Tambah Data Kas')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Tambah Data Kas</h1>
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

    <form action="/admin/kas/store" method="POST">
		@csrf
    <div class="card-body">
      <div class="row"> 
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Siklus</label>
            <select name="siklus_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            <option selected="" disabled="" >-- Pilih siklus transaksi --</option>
                @foreach ($sikluses as $siklus)
                    <option value="{{ $siklus->siklus_id }}">
                        {{ $siklus->nama_siklus }} - {{ $siklus->farm->nama_farm }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jenis Transaksi</label>
            <select name="jenis_transaksi_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
                <option selected="" disabled="" >-- Pilih jenis transaksi --</option>
                @foreach ($transaksies as $transaksi)
                    <option value="{{ $transaksi->jenis_transaksi_id }}">
                        {{ $transaksi->jenis_transaksi }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
            <input type="date" class="form-control" id="exampleControlInput1" name="tanggal" placeholder="Isi !" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Uraian</label>
            <input type="text" class="form-control" id="exampleControlInput1" name="uraian" placeholder="Isi uraian transaksi!" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Volume</label>
            <input type="number" class="form-control" id="exampleControlInput1" name="vol" placeholder="Isi banyaknya jumlah!">
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Satuan</label>
            <select name="satuan_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            <option selected="" disabled="" >-- Pilih satuan transaksi --</option>
                @foreach ($satuanes as $satuan)
                    <option value="{{ $satuan->satuan_id }}">
                        {{ $satuan->satuan }} 
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Harga Satuan</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" name="harga_satuan" placeholder="Isi Harga Satuan!">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Kategori</label>
            <select name="kategori_id" class="form-control" id="exampleControlInput1" required oninvalid="this.setCustomValidity('Data tidak boleh kosong!')" oninput="setCustomValidity('')">
            <option selected="" disabled="" >-- Pilih kategori transaksi --</option>
                @foreach ($kategories as $kategori)
                    <option value="{{ $kategori->kategori_id }}">
                        {{ $kategori->kategori }} 
                    </option>
                @endforeach
            </select>
        </div>
        <!-- <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Pengeluaran</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="keterangan" placeholder="Isi Keterangan">
        </div>
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Pemasukan</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="keterangan" placeholder="Isi Keterangan">
        </div> -->
        <!-- <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Jumlah Harga</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="jumlah" placeholder="Jumlah volume dikali harga satuan">
        </div> -->
        <div class="col-md-6 mb-3">
            <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" name="keterangan" placeholder="Jika perlu isi keterangan!">
        </div>
        <div class="col-md-6 mb-3">
            <button class="btn btn-success mt-2">Simpan Data</button>
            <a href="../{{ $siklus->siklus_id }}/detail" class="btn btn-danger mt-2 ml-2">Kembali</a>
        </div>
      </div>
    </div>
	</form>
    @stop
    