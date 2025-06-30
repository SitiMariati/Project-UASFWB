@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pesanan</h1>
        <a href="{{ route('pengguna.pesanan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Detail Pesanan -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>ID Pesanan:</strong></td>
                                    <td>#{{ $pesanan->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Film:</strong></td>
                                    <td>{{ $pesanan->jadwal->film->judul }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Genre:</strong></td>
                                    <td><span class="badge badge-info">{{ $pesanan->jadwal->film->genre }}</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Durasi:</strong></td>
                                    <td>{{ $pesanan->jadwal->film->durasi }} menit</td>
                                </tr>
                                <tr>
                                    <td><strong>Jumlah Tiket:</strong></td>
                                    <td>{{ $pesanan->jumlah_tiket }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Tanggal Tayang:</strong></td>
                                    <td>{{ \Carbon\Carbon::parse($pesanan->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jam Tayang:</strong></td>
                                    <td>{{ $pesanan->jadwal->jam_tayang }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Harga per Tiket:</strong></td>
                                    <td>Rp {{ number_format($pesanan->jadwal->harga_tiket, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Harga:</strong></td>
                                    <td class="text-success font-weight-bold">
                                        @if($pesanan->total_harga)
                                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                        @else
                                            Rp {{ number_format($pesanan->jumlah_tiket * $pesanan->jadwal->harga_tiket, 0, ',', '.') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>
                                        @if($pesanan->status == 'menunggu')
                                            <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                        @elseif($pesanan->status == 'dikonfirmasi')
                                            <span class="badge badge-success">Dikonfirmasi</span>
                                        @else
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Informasi Pembayaran</h6>
                </div>
                <div class="card-body">
                    @if($pesanan->pembayaran)
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Status Pembayaran:</strong></td>
                                <td>
                                    @if($pesanan->pembayaran->status == 'menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($pesanan->pembayaran->status == 'dibayar')
                                        <span class="badge badge-success">Dibayar</span>
                                    @else
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Metode Pembayaran:</strong></td>
                                <td>{{ $pesanan->pembayaran->metode_pembayaran }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Pembayaran:</strong></td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->pembayaran->created_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-credit-card fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada pembayaran</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aksi</h6>
                </div>
                <div class="card-body">
                    @if($pesanan->status == 'menunggu')
                        <form action="{{ route('pengguna.pesanan.cancel', $pesanan->id) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Batalkan pesanan ini?')">
                                <i class="fas fa-times"></i> Batalkan Pesanan
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('pengguna.pesanan.index') }}" class="btn btn-secondary btn-block mb-2">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 