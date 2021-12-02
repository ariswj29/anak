@extends('adminlte::page')

@section('title', 'Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css"><link rel="shortcut icon" href="{{ asset('img/mardawavector.png') }}"/>
@stop

@if(auth()->user()->isAdmin())

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session()->get('success') }}
        </div>
    @endif   

    <div class="content mt-3">
        <div class="row">
            <div class="col-xl-3">
                <div class="card bg-primary shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h3 text-black mb-1">
                                    PJUB
                                </div>
                                <div class="h1 mb-0 font-weight text-gray-800">{{ $pjubs->count('pjub_id') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card bg-success shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h3 text-black mb-1">
                                    Mitra
                                </div>
                                <div class="h1 mb-0 font-weight text-gray-800">{{ $mitras->count('mitra_id') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-handshake fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card bg-warning text-white shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h3 text-white mb-1">
                                    Farm
                                </div>
                                <div class="h1 mb-0 font-weight text-white">
                                {{ $farms->count('farm_id') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-warehouse fa-2x text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3">
                <div class="card bg-danger shadow py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h3 text-black mb-1">
                                    Siklus
                                </div>
                                <div class="h1 mb-0 font-weight text-gray-800">
                                {{ $sikluses->count('siklus_id') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-th fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info -->
    <div class="content">
        <div class="row">
            <div class="col-3">
                <div class="card" style="width: 16rem;">
                    <div class="card-header text-center">
                        PJUB
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($pjubs as $pjub)
                        <li class="list-group-item">
                            {{ $pjub->nama }}
                            <div class="d-grid gap-2 d-md-flex justify-content-end">
                                <button class="btn btn-primary btn-sm" style="margin-top:-25px" data-bs-toggle="modal" data-bs-target="#pjubModal_{{ $pjub->pjub_id }}">Info</button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-3">
                <div class="card" style="width: 16rem;">
                    <div class="card-header text-center">
                        Mitra
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mitras as $mitra)
                        <li class="list-group-item">
                            {{ $mitra->nama }}
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary btn-sm" style="margin-top:-25px" data-bs-toggle="modal" data-bs-target="#mitraModal_{{ $mitra->mitra_id }}">Info</button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-3">
                <div class="card" style="width: 16rem;">
                    <div class="card-header text-center">
                        Farm
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($farms as $farm)
                        <li class="list-group-item">
                            {{ $farm->nama_farm }} - {{ $farm->mitra->nama }}
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary btn-sm" style="margin-top:-25px" data-bs-toggle="modal" data-bs-target="#farmModal_{{ $farm->farm_id }}">Info</button>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="col-3">
                <div class="card" style="width: 16rem;">
                    <div class="card-header text-center">
                        Siklus
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($sikluses as $siklus)
                        <li class="list-group-item">
                            {{ $siklus->nama_siklus }} - {{ $siklus->farm->nama_farm }}
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a class="btn btn-primary btn-sm" style="margin-top:-25px" data-bs-toggle="modal" data-bs-target="#siklusModal_{{ $siklus->siklus_id }}">Info</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    @foreach ($pjubs as $pjub)
    <div class="modal fade" id="pjubModal_{{ $pjub->pjub_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Info Data PJUB</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <tr>
                            <td>ID PJUB</td>
                            <td>{{ $pjub->pjub_id }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $pjub->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ $pjub->nik }}</td>
                        </tr>
                        <tr>
                            <td>Tampat Tanggal Lahir</td>
                            <td>{{ $pjub->tempat_lahir }}, {{ $pjub->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $pjub->alamat }}</td>
                        </tr>
                        <tr>
                            <td>No Handphone</td>
                            <td>{{ $pjub->no_hp }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $pjub->email }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="/admin/pjub/{{ $pjub->pjub_id }}/edit">Edit Data</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach    

    @foreach ($mitras as $mitra)
    <div class="modal fade" id="mitraModal_{{ $mitra->mitra_id }}" tabindex="-1" aria-labelledby="mitraModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Info Data Mitra</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table class="table">
                        <tr>
                            <td>ID Mitra</td>
                            <td>{{ $mitra->mitra_id }}</td>
                        </tr>
                        <tr>
                            <td>PJUB</td>
                            <td>{{ $mitra->pjub->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{ $mitra->nama }}</td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>{{ $mitra->nik }}</td>
                        </tr>
                        <tr>
                            <td>Tampat Tanggal Lahir</td>
                            <td>{{ $mitra->tempat_lahir }}, {{ $mitra->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $mitra->alamat }}</td>
                        </tr>
                        <tr>
                            <td>No Handphone</td>
                            <td>{{ $mitra->no_hp }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $mitra->email }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="/admin/mitra/{{ $mitra->mitra_id }}/edit">Edit Data</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @foreach ($farms as $farm)
    <div class="modal fade" id="farmModal_{{ $farm->farm_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Info Data Farm</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table class="table">
                        <tr>
                            <td>ID Farm</td>
                            <td>{{ $farm->farm_id }}</td>
                        </tr>
                        <tr>
                            <td>Nama Mitra</td>
                            <td>{{ $farm->mitra->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nama Farm</td>
                            <td>{{ $farm->nama_farm }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{ $farm->alamat_farm }}</td>
                        </tr>
                        <tr>
                            <td>Mata Uang</td>
                            <td>{{ $farm->mata_uang }}</td>
                        </tr>
                        <tr>
                            <td>Satuan Berat</td>
                            <td>{{ $farm->satuan_berat }}</td>
                        </tr>
                        <tr>
                            <td>Kapasitas Rak Telur</td>
                            <td>{{ $farm->kapasitas_rak_telur }}</td>
                        </tr>
                        <tr>
                            <td>Kapasitas Kandang Doc</td>
                            <td>{{ $farm->kapasitas_kandang_doc }}</td>
                        </tr>
                        <tr>
                            <td>Kapasitas Kandang Grower</td>
                            <td>{{ $farm->kapasitas_kandang_grower }}</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary"href="/admin/farm/{{ $farm->farm_id }}/edit">Edit Data</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    @foreach ($sikluses as $siklus)
    <div class="modal fade" id="siklusModal_{{ $siklus->siklus_id }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Info Data Siklus</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <!-- <form action" method="get"> -->
                    <table class="table table-hover" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>ID Siklus</td>
                            <td>{{ $siklus->siklus_id }}</td>
                        </tr>
                        <tr>
                            <td>Nama Farm</td>
                            <td>{{ $siklus->farm->nama_farm }} - {{ $farm->mitra->nama }}</td>
                        </tr>
                        <tr>
                            <td>Nama Siklus</td>
                            <td>{{ $siklus->nama_siklus }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>{{ $siklus->tanggal }}</td>
                        </tr>
                        <tr>
                            <td>Jenis ternak</td>
                            <td>{{ $siklus->jenis_ternak }}</td>
                        </tr>
                        <tr>
                            <td>Jumlah Ternak</td>
                            <td>{{ $siklus->jumlah_ternak }}</td>
                        </tr>
                        <tr>
                            <td>Harga Satuan DOC</td>
                            <td>{{ $siklus->harga_satuan_doc }}</td>
                        </tr>
                        <tr>
                            <td>Supplier</td>
                            <td>{{ $siklus->supplier }}</td>
                        </tr>
                    </table>
                </form>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary"href="/admin/siklus/{{ $siklus->siklus_id }}/edit">Edit Data</a>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@stop
    
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
