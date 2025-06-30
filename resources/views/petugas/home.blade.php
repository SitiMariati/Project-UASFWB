@extends('layouts.app')

@section('title', 'Home Petugas')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Home Petugas</h1>
        <a href="{{ route('petugas.dashboard') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-chart-line fa-sm text-white-50"></i> Dashboard
        </a>
    </div>

    <!-- Welcome Message -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h4 class="text-primary">Selamat Datang, {{ Auth::user()->name }}!</h4>
                    <p class="mb-0">Selamat datang di panel petugas sistem pembelian tiket bioskop online. Anda dapat mengelola pemesanan, konfirmasi pembayaran, dan scan tiket.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemesanan Menunggu Konfirmasi -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Pemesanan Menunggu Konfirmasi</h6>
                </div>
                <div class="card-body">
                    @if($pemesananMenunggu->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemesan</th>
                                        <th>Film</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Jam Tayang</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemesananMenunggu as $pemesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pemesanan->user->name }}</td>
                                        <td>{{ $pemesanan->jadwal->film->judul }}</td>
                                        <td>{{ $pemesanan->jumlah_tiket }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>{{ $pemesanan->jadwal->jam_tayang }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
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
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                            <h5 class="text-success">Tidak ada pemesanan yang menunggu konfirmasi</h5>
                            <p class="text-muted">Semua pemesanan telah diproses</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-info">Jadwal Tayang Hari Ini</h6>
                </div>
                <div class="card-body">
                    @if($jadwalHariIni->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Film</th>
                                        <th>Jam Tayang</th>
                                        <th>Harga Tiket</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalHariIni as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $jadwal->film->judul }}</td>
                                        <td>{{ $jadwal->jam_tayang }}</td>
                                        <td>Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</td>
                                        <td>
                                            @if(\Carbon\Carbon::parse($jadwal->jam_tayang)->isPast())
                                                <span class="badge badge-secondary">Selesai</span>
                                            @else
                                                <span class="badge badge-success">Akan Tayang</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada jadwal tayang hari ini</h5>
                            <p class="text-muted">Tidak ada film yang dijadwalkan untuk hari ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('petugas.pemesanan.index') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-list"></i> Kelola Pemesanan
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('petugas.tiket.index') }}" class="btn btn-success btn-block">
                                <i class="fas fa-ticket-alt"></i> Kelola Tiket
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('petugas.tiket.scan') }}" class="btn btn-info btn-block">
                                <i class="fas fa-qrcode"></i> Scan Tiket
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('petugas.dashboard') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-chart-line"></i> Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 