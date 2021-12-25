@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaraPost</title>
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/cr-1.5.4/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.0.1/b-colvis-2.0.1/b-html5-2.0.1/cr-1.5.4/datatables.min.js"></script>
    <meta charset=utf-8 />
        {{-- import file bootstrap  --}}
        <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
    <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> 
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-html5-2.1.1/datatables.min.css"/> -->

@stop

@if(auth()->user()->isAdmin())

@section('content_header')
    <h1 class="m-0 text-dark">Pembelanjaan Modal</h1>
@stop

@section('content')
<div class="detail-mitra">
<div class="table-responsive-md">
    <table id="capex-table" class="table table-bordered table-hover">
        <thead>
            <tr>
            <th>No</th>
            <th>Perlengkapan</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th>Subtotal</th>
            <th>Keterangan</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.3/b-2.1.1/b-html5-2.1.1/datatables.min.js"></script>

        <!-- Bootstrap JavaScript -->
        <!-- <script src="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script> -->
        <!-- <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script> -->
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<!-- <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> -->
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap.min.js"></script>


        <script>

        </script>
        <script>
            $(document).ready(function() {
                $('#capex-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/admin/capex/{{ $farm_id }}/detail/json',
                    fixedHeader: true,
                    colReorder: true,
                    responsive: true,
                    sPaginationType: "full_numbers",
                    bLengthChange: true,
                    aLengthMenu: [[5, 10, 15, 20, -1], [5, 10, 15, 20, , "All"]],
                    iDisplayLength: 5,
                    aaSorting: [1, 'asc'],
                    bProcessing: true,
                    order: [ [ 3, "DEC" ] ],
                    destroy: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf',
                        {
                        text: 'JSON',
                        action: function (e, dt, button, config) {
                            var data = dt.buttons.exportData();

                            $.fn.dataTable.fileSave(
                                new Blob([JSON.stringify(data)]),
                                'Export.json'
                            );
                        }
                    }
                    ],
                    // ajax: [
                    //     url: '/admin/capex/{{ $farm_id }}/detail/json',
                    //     type: 'GET',
                    //     data : data,
                    //     dataSrc: '',
                    //     error: function (e) {
                    //         errorHandler(e);
                    //     }
                    // ],

                    columns: [
                        // $capex = Capex::find($capex_id);
                        { data: 'no', name:'id', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }},
                        { data: 'capex', name: 'capex' },
                        { data: 'jumlah', name: 'jumlah' },
                        { data: 'harga', name: 'harga' },
                        { data: 'satuan', name: 'satuan'},
                        { data: 'subtotal', name: 'subtotal' },
                        { data: 'keterangan', name: 'keterangan' },
                        { data: 'capex_id', name: 'capex_id', render: function (data, type, row, meta) { 
                            return '<a class="btn btn-info btn-sm" href="/admin/capex/'+row.capex_id+'/edit">Edit</a><br><a class="btn btn-danger btn-sm" href="/admin/capex/'+row.capex_id+'/'+row.farm_id+'/delete" >Hapus</a>';
                        }},
                    // {
                    //     "className":      'details-control',
                    //     "orderable":      false,
                    //     "data":           null,
                    //     "defaultContent": ''
                    // },
                    ]                    
                });
            });
        </script>
@stop

</div>
</div>

@endif




