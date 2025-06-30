@extends('layouts.app')

@section('title', 'Transaksi Pemesanan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-receipt text-primary mr-2"></i>
            Transaksi Pemesanan
        </h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Content Row - Statistik -->
    <div class="row mb-4">
        <!-- Total Pendapatan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pendapatan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPendapatan) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Menunggu -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Konfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMenunggu }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Dikonfirmasi -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dikonfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDikonfirmasi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pemesanan Dibatalkan -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Dibatalkan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDibatalkan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi Pemesanan</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if($pemesanan->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Pemesanan</th>
                                <th>Nama Pemesan</th>
                                <th>Film</th>
                                <th>Jadwal Tayang</th>
                                <th>Jumlah Tiket</th>
                                <th>Harga per Tiket</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Status Tiket</th>
                                <th>Tanggal Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan as $index => $pesan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>#{{ $pesan->id }}</strong></td>
                                <td>
                                    <div class="font-weight-bold">{{ $pesan->user->name }}</div>
                                    <small class="text-muted">{{ $pesan->user->email }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ $pesan->jadwal->film->judul }}</div>
                                    <small class="text-muted">{{ $pesan->jadwal->film->genre }}</small>
                                </td>
                                <td>
                                    <div class="font-weight-bold">{{ \Carbon\Carbon::parse($pesan->jadwal->tanggal_tayang)->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $pesan->jadwal->jam_tayang }}</small>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $pesan->jumlah_tiket }} tiket</span>
                                </td>
                                <td>Rp {{ number_format($pesan->jadwal->harga_tiket) }}</td>
                                <td>
                                    <strong class="text-success">Rp {{ number_format($pesan->jumlah_tiket * $pesan->jadwal->harga_tiket) }}</strong>
                                </td>
                                <td>
                                    @if($pesan->status == 'menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($pesan->status == 'dikonfirmasi')
                                        <span class="badge badge-success">Dikonfirmasi</span>
                                    @else
                                        <span class="badge badge-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($pesan->status_tiket == 'belum_digunakan')
                                        <span class="badge badge-info">Belum Digunakan</span>
                                    @elseif($pesan->status_tiket == 'sudah_digunakan')
                                        <span class="badge badge-secondary">Sudah Digunakan</span>
                                    @else
                                        <span class="badge badge-light">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div>{{ $pesan->created_at->format('d/m/Y') }}</div>
                                    <small class="text-muted">{{ $pesan->created_at->format('H:i') }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                    <h5 class="text-gray-500">Belum ada transaksi pemesanan</h5>
                    <p class="text-muted">Transaksi akan muncul di sini setelah ada pemesanan tiket</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- DataTables Script -->
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "order": [[ 10, "desc" ]], // Sort by tanggal pemesanan descending
        "pageLength": 25,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });
});
</script>
@endsection 