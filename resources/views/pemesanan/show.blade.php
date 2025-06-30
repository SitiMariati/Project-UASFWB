@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detail Pemesanan</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nama Pemesan: {{ $pemesanan->nama }}</h5>

                <p class="card-text">
                    <strong>Film:</strong> {{ $pemesanan->film->judul }} <br>
                    <strong>Jumlah Tiket:</strong> {{ $pemesanan->jumlah_tiket }} <br>
                    <strong>Tanggal Tayang:</strong> {{ \Carbon\Carbon::parse($pemesanan->tanggal_tayang)->format('d-m-Y') }} <br>
                    <strong>Status:</strong>
                    @if ($pemesanan->status == 'menunggu')
                        <span class="badge text-bg-warning">Menunggu</span>
                    @elseif ($pemesanan->status == 'dikonfirmasi')
                        <span class="badge text-bg-success">Dikonfirmasi</span>
                    @else
                        <span class="badge text-bg-danger">Dibatalkan</span>
                    @endif
                </p>

                <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('pemesanan.edit', $pemesanan->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
@endsection
