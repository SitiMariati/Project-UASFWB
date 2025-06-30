@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Petugas</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Pemesanan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pemesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPemesanan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Menunggu Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Konfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesananMenunggu }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Dikonfirmasi Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dikonfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesananDikonfirmasi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Dibatalkan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Dibatalkan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pemesananDibatalkan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Pemesanan Terbaru -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pemesanan Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Film</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Tanggal Tayang</th>
                                    <th>Status</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPemesanan as $pemesanan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pemesanan->user->name }}</td>
                                    <td>{{ $pemesanan->jadwal->film->judul }}</td>
                                    <td>{{ $pemesanan->jumlah_tiket }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                    <td>
                                        @if($pemesanan->status == 'menunggu')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($pemesanan->status == 'dikonfirmasi')
                                            <span class="badge badge-success">Dikonfirmasi</span>
                                        @else
                                            <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($pemesanan->status == 'menunggu')
                                            <form action="{{ route('petugas.konfirmasi', $pemesanan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pemesanan ini?')">
                                                    <i class="fas fa-check"></i> Konfirmasi
                                                </button>
                                            </form>
                                            <form action="{{ route('petugas.batal', $pemesanan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan pemesanan ini?')">
                                                    <i class="fas fa-times"></i> Batal
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('petugas.pemesanan.show', $pemesanan->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada pemesanan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 