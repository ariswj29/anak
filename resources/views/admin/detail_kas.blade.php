@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Detail Buku Kas')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@stop

@if(auth()->user()->isAdmin())

@section('content_header')
    <h1 class="m-0 text-dark">Detail Kas</h1>
@stop

@section('content')
<div class="detail-kas">

    <div class="row justify-content-between">
        <div class="col-md">
                <a href="/admin/kas/{{ $siklus_id }}/tambah" class="btn btn-primary mr-2 mb-2"><i class="fas fa-plus"></i> Tambah Data Kas</a>
                <a href="/admin/kas/{{ $siklus_id }}/export_excel" class="btn btn-secondary mb-2" target="_blank"><i class="fas fa-print"></i> Export Excel</a>
        </div>
    </div>
        
<div class="container">
    <div class="table-responsive">
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Vol</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Kategori</th>
                <th>Debit</th>
                <th>Kredit</th>
                <th>Saldo</th>
                <!-- <th>Ket</th> -->
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
                ajax: '/admin/kas/{{ $siklus_id }}/detail',
                columns: [
                    { data: 'no', name:'kas_id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'uraian', name: 'uraian'},
                    {data: 'vol', name: 'vol'},
                    {data: 'satuan', name: 'satuan'},
                    {data: 'harga_satuan', name: 'harga_satuan'},
                    {data: 'kategori', name: 'kategori'},
                    {data: 'debit', name: 'debit'},
                    {data: 'kredit', name: 'kredit'},
                    {data: 'saldo', name: 'saldo'},
                    { data: 'kas_id', name: 'kas_id', render: function (data, type, row, meta) { 
                        return '<a class="btn btn-info btn-sm mr-2" href="/admin/kas/'+row.kas_id+'/edit"><i class="fas fa-edit"></i></a><a class="btn btn-danger btn-sm" href="/admin/kas/'+row.kas_id+'/delete" ><i class="fas fa-trash"></i></a>';
                    }},
                ]
            });
            
        });
    </script>
</div>   
@stop
    
@endif

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script>

@endsection
