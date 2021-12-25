@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Vitamin ')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Vitamin</h1>
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
            <a class="btn btn-success mr-2 mb-2" style="font-family: Source Sans Pro"; href="/admin/vitamin/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
            <a href="/admin/vitamin/export_excel" class="btn btn-secondary mb-2" target="_blank"><i class="fas fa-print"></i> Export Excel</a>
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
                <th>Jenis Vitamin</th>
                <th>Jumlah Vitamin (l/butir)</th>
                <th>Nama Farm</th>
                <th>Mitra</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>
    <script type="text/javascript">
        $(function () {
            
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin/vitamin') }}",
                columns: [
                    { data: 'no', name:'vitamin_id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'nama_siklus', name: 'nama_siklus'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'jenis_vitamin', name: 'jenis_vitamin'},
                    {data: 'jumlah_vitamin', name: 'jumlah_vitamin'},
                    {data: 'nama_farm', name: 'nama_farm'},
                    {data: 'nama', name: 'nama'},
                    { data: 'vitamin_id', name: 'vitamin_id', render: function (data, type, row, meta) { 
                        return '<a class="btn btn-info btn-sm mr-2" href="/admin/vitamin/'+row.vitamin_id+'/edit"><i class="fas fa-edit"></i></a><a class="btn btn-danger btn-sm" href="/admin/vitamin/'+row.vitamin_id+'/delete" ><i class="fas fa-trash"></i></a>';
                    }},
                ]
            });
            
        });
    </script>
</div>   
@stop
