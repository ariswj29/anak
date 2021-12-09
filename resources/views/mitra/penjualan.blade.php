@extends('adminlte::page')

@section('title', ' Aplikasi Ternak | Penjualan')

@section('css')
    <meta charset="utf-8" >
    <meta name="author" content="GOYANG DUMET">
    <meta http-equiv="Content-Type" content="text/html">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
	<link rel="stylesheet" type="text/css" href="/css/jquery.fancybox.css?v=2.1.5" media="screen">
	<!-- Selector -->
@stop

@section('js')
    <!-- Jquery -->
    <script type="text/javascript" src="/js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="/js/jquery.fancybox.js?v=2.1.5"></script>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Penjualan</h1>
@stop

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif    

    <div class="row justify-content-between mt-2">
        <div class="col-md-2">
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro"; href="/mitra/penjualan/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="table-responsive-md">
    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
                <thead>
                <tr class="thead">
                          <th class="header-tabel-data" scope="col-3" >No.</th>
                          <th class="header-tabel-data" scope="col" >Siklus</th>
                          <th class="header-tabel-data" scope="col" >Tanggal</th>
                          <th class="header-tabel-data" scope="col" >Jumlah Ekor</th>
                          <th class="header-tabel-data" scope="col" >Bobot Jual</th>
                          <th class="header-tabel-data" scope="col" >Jumlah Nominal</th>
                          <th class="header-tabel-data" scope="col" >Foto</th>
                          <th class="header-tabel-data" scope="col" >Aksi</th>
                </tr>
                </thead>
                <tbody> 
                <?php $no=1;?>
                    @foreach ($recording as $record)
                    <tr>
                        <td class="px-6 py-3 leading-6 text-center whitespace-nowrap">
                            
                            {{ $no }}
                        </td>
                        <td>
                            {{ $record->nama_siklus }} - {{ $record->nama_farm }} 
                        </td>
                        <td>
                            {{ $record->tanggal }}
                        </td>
                        <td>
                            {{ $record->jumlah }}
                        </td>
                        <td>
                            {{ $record->bobot_jual }}
                        </td>
                        <td>
                            {{ $record->jumlah_nominal }}
                        </td>
                        <td>
                            <a href="{{ asset('images/'.$record->foto) }}" style="width: 300px; height: 300px;" class="perbesar">
                                <img src="{{ asset('images/'.$record->foto) }}" style="width: 50px; height: 50px;" alt="">
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm my-1" href="/mitra/penjualan/{{ $record->penjualan_id }}/edit"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="/mitra/penjualan/{{ $record->penjualan_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>  
                        </td>
                    </tr>
                    <?php $no++ ;?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
@stop

    <script type="text/javascript">
		$(document).ready(function(){
			$(".perbesar").fancybox();
		})
	</script>