@extends('adminlte::page')

@section('title', 'Mitra | Aplikasi Ternak')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Mitra</h1>
@stop

@section('content')

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        {{ session()->get('success') }}
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    </div>
    <!-- <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
            {{ session()->get('success') }}
            </div>
        </div>
    </div> -->
    @endif    

    <div class="row justify-content-between mt-2">
        <div class="col-md-2">
            <a class="btn btn-success mb-2" style=" font-family: Source Sans Pro"; href="/pjub/mitra/tambah"><i class="fas fa-plus"></i> Tambah Data</i></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-hover" border="1" cellspacing="0" cellpadding="0">
                <thead>
                <tr class="thead">
                    <th class="header-tabel-data" scope="col-3" >No.</th>
                    <th class="header-tabel-data" scope="col" >Nama</th>
                    <th class="header-tabel-data" scope="col" >NIK</th>
                    <th class="header-tabel-data" scope="col" >Tempat Lahir</th>
                    <th class="header-tabel-data" scope="col" >Tanggal Lahir</th>
                    <th class="header-tabel-data" scope="col" >Alamat</th>
                    <th class="header-tabel-data" scope="col" >No HP</th>
                    <th class="header-tabel-data" scope="col" >Email</th>
                    <th class="header-tabel-data" scope="col" >Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($recording as $record)
                <tr>
                    <td class=" text-center whitespace-nowrap">
                        {{ $record->no }}
                    </td>
                    <td class="">
                        {{ $record->nama }}
                    </td>
                    <td class="">
                        {{ $record->nik }}
                    </td>
                    <td class="">
                        {{ $record->tempat_lahir }}
                    </td>
                    <td class="">
                        {{ $record->tanggal_lahir }}
                    </td>
                    <td class="">
                        {{ $record->alamat }}
                    </td>
                    <td class="">
                        {{ $record->no_hp }}
                    </td>
                    <td class="">
                        {{ $record->email }}
                    </td>
                    <td class="">
                        <a class="btn btn-info btn-sm my-1" href="/pjub/mitra/{{ $record->mitra_id }}/edit"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm my-1" href="/pjub/mitra/{{ $record->mitra_id }}/delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data tersebut?');"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('scripts')
<script src="js/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 4000);
    });    
</script>
@endsection