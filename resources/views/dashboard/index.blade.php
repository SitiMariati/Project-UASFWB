@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1 class="mb-4">Selamat Datang, {{ Auth::user()->name }}!</h1>

        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Film</h5>
                        <p class="card-text">Tambah, edit, atau hapus data film.</p>
                        <a href="{{ route('films.index') }}" class="btn btn-light">Lihat Film</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Jadwal</h5>
                        <p class="card-text">Atur jadwal tayang film.</p>
                        <a href="" class="btn btn-light">Lihat Jadwal</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Kelola Pemesanan</h5>
                        <p class="card-text">Kelola transaksi pemesanan tiket.</p>
                        <a href="" class="btn btn-light">Lihat Pemesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
