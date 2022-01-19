@extends('adminlte::page')

@section('title', ' Aplikasi Ternak | Penjualan')

@section('css')
    <meta charset="utf-8" >
    <meta name="author" content="GOYANG DUMET">
    <meta http-equiv="Content-Type" content="text/html">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   --> 
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> 
    <script src="../../extensions/Editor/js/dataTables.editor.min.js"></script>
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

    <div class="row justify-content-between">
        <div class="col-md">
            <a class="btn btn-success ml-2 mr-2 mb-2" style=" font-family: Source Sans Pro"; href="/mitra/penjualan/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
            <a href="/mitra/penjualan/export_excel" class="btn btn-secondary mb-2" target="_blank"><i class="fas fa-print"></i> Export Excel</a>
        </div>
    </div>

<div class="container">
    <div class="table-responsive">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Siklus</th>
                <th>Tanggal</th>
                <th>Jumlah Ekor</th>
                <th>Bobot Jual (g)</th>
                <th>Jumlah Nominal</th>
                <!-- <th>Foto</th> -->
                <th style="width:88px">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>

    <!-- Modal -->
    @foreach ($penjualans as $penjualan)
    <div class="modal fade" id="exampleModal{{ $penjualan->penjualan_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <!-- <tr>
                        <td>ID Penjualan</td>
                        <td>{{ $penjualan->penjualan_id }}</td>
                    </tr> -->
                    <tr>
                        <td>Nama Siklus</td>
                        <td>{{ $penjualan->nama_siklus }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Jual</td>
                        <td>{{ \Carbon\Carbon::parse($penjualan->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Ekor</td>
                        <td>{{ $penjualan->jumlah }}</td>
                    </tr>
                    <tr>
                        <td>Bobot Jual</td>
                        <td>{{ number_format($penjualan->bobot_jual, 0, ',', '.') }} g</td>
                    </tr>
                    <tr>
                        <td>Jumlah Nominal</td>
                        <td>Rp. {{ number_format($penjualan->jumlah_nominal, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td><img src="/images/{{ $penjualan->foto }}" height="100px" width="100px" alt=""></td>
                    </tr>
                </table>
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
    @endforeach

    <script type="text/javascript">
        $(function () {
            
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('mitra/penjualan') }}",
                columns: [
                    { data: 'no', name:'penjualan_id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'nama_siklus', name: 'nama_siklus'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'jumlah', name: 'jumlah'},
                    {data: 'bobot_jual', name: 'bobot_jual'},
                    {data: 'jumlah_nominal', name: 'jumlah_nominal'},
                    // {data: 'foto', name: 'foto', render: function (data, type, row, meta) {
                    //     return '<img src="'+data+'" height="50" width="50"/>';
                    // }},
                    // {data: 'nama_farm', name: 'nama_farm'},
                    // {data: 'nama', name: 'nama'},
                    { data: 'penjualan_id', name: 'penjualan_id', render: function (data, type, row, meta) { 
                        return '<button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#exampleModal'+row.penjualan_id+'"><i class="fas fa-eye"></i></button><a class="btn btn-info btn-sm mr-2" href="/mitra/penjualan/'+row.penjualan_id+'/edit"><i class="fas fa-edit"></i></a><a class="btn btn-danger btn-sm" href="/mitra/penjualan/'+row.penjualan_id+'/delete" onclick="return confirm(`Apakah data ini mau dihapus?`)"><i class="fas fa-trash"></i></a>';
                    }},
                ]
            });
            
        });
    </script>
</div>   
@stop

@section('scripts')
<script src="js/jquery.min.js"></script>

<script type="text/javascript">
		$(document).ready(function(){
			$(".perbesar").fancybox();
		})
</script>

@endsection