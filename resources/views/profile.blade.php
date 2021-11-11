@extends('adminlte::page')

@section('title', 'Aplikasi Ternak | Profile')

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('content_header')
    <h1 class="m-0 text-dark">Profile</h1>
@stop

@section('content')

@if($pjub)
<x-adminlte-profile-widget class="elevation-4" name="{{ $pjub->nama }}" desc="PJUB"
    img='https://picsum.photos/300/300'
    header-class="text-black text-left" footer-class='bg-gradient-light'>
    <x-adminlte-profile-col-item title="NIK : {{ $pjub->nik }}" size=12/>
    <x-adminlte-profile-col-item title="Tampat Tanggal Lahir : {{ $pjub->tempat_lahir }}, {{ $pjub->tanggal_lahir }}" size=12/>
    <x-adminlte-profile-col-item title="Alamat : {{ $pjub->alamat }}" size=12/>
    <x-adminlte-profile-col-item title="No Handphone : {{ $pjub->no_hp }}" size=12/>
    <x-adminlte-profile-col-item title="Email : {{ $pjub->email }}" size=12/>
</x-adminlte-profile-widget>
@endif

@if($mitra)
<x-adminlte-profile-widget class="elevation-4" style="font-weight:50" name="{{ $mitra->nama }}" desc="Mitra"
    img='https://picsum.photos/300/300'
    header-class="text-black text-left" footer-class='bg-gradient-light'>
    <x-adminlte-profile-col-item title="NIK : {{ $mitra->nik }}" size=12/>
    <x-adminlte-profile-col-item title="Tampat Tanggal Lahir : {{ $mitra->tempat_lahir }}, {{ $mitra->tanggal_lahir }}" size=12/>
    <x-adminlte-profile-col-item title="Alamat : {{ $mitra->alamat }}" size=12/>
    <x-adminlte-profile-col-item title="No Handphone : {{ $mitra->no_hp }}" size=12/>
    <x-adminlte-profile-col-item title="Email : {{ $mitra->email }}" size=12/>
    <x-adminlte-profile-col-item title="PJUB : {{ $mitra->pjub->nama }}" size=12/>
</x-adminlte-profile-widget>

<div class="profil-password">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center">Ganti Password</div>
    
                    <div class="card-body">

                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session()->get('success') }}
                            </div>
                        @endif  

                        <form method="POST" action="{{ route('profile') }}">
                            @csrf 
    
                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach 
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password Sebelumnya</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password Baru</label>
    
                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Konfirmasi Password Baru</label>
        
                                <div class="col-md-6">
                                    <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Ubah Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
    
    @stop

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
