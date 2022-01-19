@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Detail Buku Kas')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.css"/>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> 
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" /> -->
    <!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.js"></script>
@stop

@if(auth()->user()->isAdmin())

@section('content_header')
    <h1 class="m-0 text-dark">Detail Kas</h1>
@stop

@section('content')
<div class="detail-kas">

    <div class="row justify-content-between">
        <div class="col-md">
            <a href="/admin/kas/{{ $siklus_id }}/tambah" class="btn btn-primary ml-2 mr-2 mb-2"><i class="fas fa-plus"></i> Tambah Data Kas</a>
            <a href="/admin/kas/{{ $siklus_id }}/detail/export_excel" class="btn btn-secondary mb-2" target="_blank"><i class="fas fa-print"></i> Export Excel</a>
        </div>
    </div>   
        
<div class="container">
    <div class="table-responsive">
    <table class="table table-bordered" id="datatable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Jenis Kategori</th>
                <th>Vol</th>
                <!-- <th>Satuan</th> -->
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th style="width:88px">Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    </div>

    <!-- Modal -->
    @foreach ($kases as $kas)
    <div class="modal fade" id="exampleModal{{ $kas->kas_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <tr>
                        <td>ID kas</td>
                        <td>{{ $kas->kas_id }}</td>
                    </tr>
                    <tr>
                        <td>Nama Siklus</td>
                        <td>{{ $kas->nama_siklus }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>{{ \Carbon\Carbon::parse($kas->tanggal)->isoFormat('D MMMM Y') }}</td>
                    </tr>
                    <tr>
                        <td>Uraian Transaksi</td>
                        <td>{{ $kas->uraian }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Transaksi</td>
                        <td>{{ $kas->jenis_transaksi }}</td>
                    </tr>
                    <tr>
                        <td>Volume</td>
                        <td>{{ $kas->vol }}</td>
                    </tr>
                    <tr>
                        <td>Satuan</td>
                        <td>{{ $kas->satuan }}</td>
                    </tr>
                    <tr>
                        <td>Harga Satuan</td>
                        <td>{{ $kas->harga_satuan }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>{{ $kas->kategori }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>{{ $kas->keterangan }}</td>
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
            
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                paging: false,
                ajax: "/admin/kas/{{ $siklus_id }}/get_data_kas",
                columns: [
                    { data: 'no', name:'kas_id', render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }},
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'uraian', name: 'uraian' },
                    { data: 'jenis_transaksi', name: 'jenis_transaksi' },
                    { data: 'vol', name: 'vol' },
                    // { data: 'satuan_id', name: 'satuan_id' },
                    { data: 'harga_satuan', name: 'harga_satuan' },
                    { data: 'jumlah', name: 'jumlah' },
                    { data: 'kas_id', name: 'kas_id', render: function (data, type, row, meta) { 
                        return '<button type="button" class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#exampleModal'+row.kas_id+'"><i class="fas fa-eye"></i></button><a class="btn btn-info btn-sm mr-2" href="/admin/kas/'+row.kas_id+'/edit"><i class="fas fa-edit"></i></a><a class="btn btn-danger btn-sm" href="/admin/kas/'+row.kas_id+'/'+row.siklus_id+'/delete" onclick="return confirm(`Apakah data ini mau dihapus?`)"><i class="fas fa-trash"></i></a>';
                    }},
                    
                ]
            });
            
        });
        </script>
    </div>
@stop
    
@endif

@section('scripts')
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.min.js"></script> -->

    
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   --> 
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.11.0/b-2.0.0/sl-1.3.3/datatables.min.js"></script>
    <!-- <script src="../../extensions/Editor/js/dataTables.editor.min.js"></script> -->
@endsection
