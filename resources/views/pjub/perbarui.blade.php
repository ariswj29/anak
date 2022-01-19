@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@if(auth()->user()->isPjub())

@section('content_header')
    <h1 class="m-0 text-dark">Input Data Harian</h1>
@stop

@section('content')
<form method="POST" action="/pjub/perbarui">
@csrf
    <div class="perbarui-mitra">
        <div class="row">        
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlInput1" class="form-label">Siklus</label>
                <select name="siklus_id" class="form-control" id="">
                    <option value="" selected disabled>Pilih Siklus </option>
                    @foreach ($sikluses as $siklus)
                        <option value="{{ $siklus->siklus_id }}"> {{ $siklus->nama_siklus }} - {{ $siklus->nama_farm }}  </option>
                        @endforeach
                    </select>
                </div>
            <div class="col-md-6  mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="col-6 md-3 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Rata-rata Bobot Ternak</label>
                <div class="input-group">
                    <input type="text" name="rata_rata_berat" placeholder="Isi rata-rata bobot ternak!" pattern="[0-9-,]{1-5}" class="form-control" id="rupiah1">
                    <div class="input-group-append">
                        <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">gram</label>
                    </div>
                </div>
            </div>
            <div class="col-6 md-3 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Tambah Stok Pakan</label>
                <div class="input-group">
                    <input type="number" name="jumlah_pakan" placeholder="Isi jika stok pakan ditambah!" class="form-control" id="angka1">
                    <div class="input-group-append">
                        <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">gram</label>
                    </div>
                </div>
            </div>
            <div class="col-6 md-3 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Pakan Harian</label>
                <div class="input-group">
                    <input type="text" name="pakan_digunakan" placeholder="Isi pakan per hari!" pattern="[0-9-,]{1-7}" class="form-control" id="angka2">
                    <div class="input-group-append">
                        <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">gram</label>
                    </div>
                </div>
            </div>
            <div class="col-6 md-3 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Minum Harian</label>
                <div class="input-group">
                    <input type="text" name="jumlah_minum" placeholder="Isi minum per hari!" pattern="[0-9-,]{1-7}" class="form-control" id="exampleFormControlInput1">
                    <div class="input-group-append">
                        <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">liter</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Vitamin</label>
                <div class="input-group">
                    <input type="text" name="jenis_vitamin" placeholder="Isi jika diberi vitamin!" class="form-control" id="exampleFormControlInput1">
                </div>
            </div>
            <div class="col-6 md-3 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Vitamin digunakan</label>
                <div class="input-group">
                    <input type="number" name="jumlah_vitamin" placeholder="Isi jika diberi vitamin!" class="form-control" id="exampleFormControlInput1">
                    <div class="input-group-append">
                        <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">butir/liter</label>
                    </div>
                </div>
            </div>
            <div class="col-6 md-3 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Kematian</label>
                <div class="input-group">
                    <input type="number" name="jumlah_kematian" placeholder="Isi jika ada kematian!" class="form-control" id="exampleFormControlInput1">
                    <div class="input-group-append">
                        <label class="input-group-text" style="background-color:white;" for="inputGroupSelect02">ekor</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Penyebab Kematian</label>
                <div class="input-group">
                    <textarea name="penyebab" placeholder="Isi jika ada kematian!" class="form-control" id="exampleFormControlInput1"></textarea>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <button class="btn btn-primary" style="width: 100%; border-radius: 20px; margin-top:15px">Simpan</button>
            </div>
        </div>
    </div>
</form>
    @stop
    
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/main.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="https://unpkg.com/currency.js@1.2.2/dist/currency.min.js"></script> <!-- plugin untuk hasilnya -->
<script type="text/javascript" src="jquery.masknumber.js"></script> <!-- plugin untuk inputannya -->
<script>
$(document).ready(function(){
		$(".inp").keyup(function(){

			var angkaSatu = $("#angka1").maskNumber({integer: true, thousands: '.'}) //kalo mau koma. titik ganti koma
			var angkaDua = $("#angka2").maskNumber({integer: true, thousands: '.'})

			var angka1 = angkaSatu.val()
			var angka2 = angkaDua.val()

			var tes1 = angka1.split("")
			for( var i = 0; i < tes1.length; i++){ 
				 if ( tes1[i] === ',' || tes1[i] === '.') {
		     tes1.splice(i, 1); 
		   }
			}

			var tes2 = angka2.split("")
			for( var i = 0; i < tes2.length; i++){ 
				 if ( tes2[i] === ',' || tes2[i] === '.') {
		     tes2.splice(i, 1); 
		   }
			}


			var filterAngka1 = parseInt(tes1.join(""))
			var filterAngka2 = parseInt(tes2.join(""))

			var hasil = filterAngka1 + filterAngka2

			$("#hasil").val(currency(hasil).format())

		})

	})
</script>