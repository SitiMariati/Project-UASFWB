@extends('layouts.app')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-ticket-alt mr-2"></i>Detail Pemesanan #{{ $pemesanan->id }}</span>
                    <a href="{{ route('petugas.pemesanan.index') }}" class="btn btn-light btn-sm"><i class="fas fa-arrow-left mr-1"></i> Kembali</a>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-primary font-weight-bold mb-3">Data Pemesan</h6>
                            <p><strong>Nama:</strong> {{ $pemesanan->user->name }}</p>
                            <p><strong>Email:</strong> {{ $pemesanan->user->email }}</p>
                            <p><strong>Jumlah Tiket:</strong> {{ $pemesanan->jumlah_tiket }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary font-weight-bold mb-3">Data Film</h6>
                            <p><strong>Film:</strong> {{ $pemesanan->jadwal->film->judul }}</p>
                            <p><strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d/m/Y') }} {{ $pemesanan->jadwal->jam_tayang }}</p>
                            <p><strong>Studio:</strong> {{ $pemesanan->jadwal->studio ? 'Studio ' . $pemesanan->jadwal->studio : '-' }}</p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary font-weight-bold mb-3">Informasi Pembayaran</h6>
                            <div class="alert alert-info">
                                <strong>Total Harga:</strong> Rp {{ number_format($pemesanan->total_harga ?? $pemesanan->jumlah_tiket * $pemesanan->jadwal->harga_tiket, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h6 class="text-primary font-weight-bold mb-3">Status Pemesanan</h6>
                            @if($pemesanan->status == 'menunggu')
                                <div class="alert alert-warning">
                                    <i class="fas fa-clock mr-2"></i>
                                    <strong>Menunggu Konfirmasi</strong> - Pemesanan menunggu konfirmasi pembayaran
                                </div>
                            @elseif($pemesanan->status == 'dikonfirmasi')
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <strong>Dikonfirmasi</strong> - Pemesanan telah dikonfirmasi
                                </div>
                            @else
                                <div class="alert alert-danger">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    <strong>Dibatalkan</strong> - Pemesanan telah dibatalkan
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($pemesanan->status == 'menunggu')
                        <div class="row">
                            <div class="col-12">
                                <h6 class="text-primary font-weight-bold mb-3">Aksi Petugas</h6>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('petugas.konfirmasi', $pemesanan->id) }}" method="POST" class="mr-2">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-lg" onclick="return confirm('Konfirmasi pembayaran untuk pemesanan ini?')">
                                            <i class="fas fa-check mr-2"></i> Konfirmasi Pembayaran
                                        </button>
                                    </form>
                                    <form action="{{ route('petugas.batal', $pemesanan->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('Batalkan pemesanan ini?')">
                                            <i class="fas fa-times mr-2"></i> Batalkan Pemesanan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <small class="text-muted">
                                <i class="fas fa-calendar mr-1"></i>
                                Dibuat: {{ $pemesanan->created_at->format('d/m/Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card { border-radius: 12px; }
.card-header { font-size: 1.1rem; font-weight: 600; }
.btn-lg { padding: 0.75rem 1.5rem; font-size: 1rem; }
.gap-2 > * { margin-right: 0.5rem; }
.gap-2 > *:last-child { margin-right: 0; }
</style>
@endsection 