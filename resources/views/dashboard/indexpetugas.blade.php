@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
    <div class="container">
        <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p>Ini adalah halaman dashboard untuk Petugas.</p>

        <div class="row">
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5>Kelola Pemesanan</h5>
                        <p>Konfirmasi dan kelola pesanan tiket.</p>
                        <a href="{{ route('pemesanan.index') }}" class="btn btn-light">Lihat Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
