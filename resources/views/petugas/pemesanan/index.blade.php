@extends('layouts.app')

@section('title', 'Kelola Pemesanan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Pemesanan</h1>
    </div>

    <!-- Filter -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form method="GET" action="{{ route('petugas.pemesanan.index') }}" class="row">
                        <div class="col-md-3">
                            <label for="status">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="film">Film:</label>
                            <select name="film" id="film" class="form-control">
                                <option value="">Semua Film</option>
                                @foreach($films as $film)
                                    <option value="{{ $film->id }}" {{ request('film') == $film->id ? 'selected' : '' }}>
                                        {{ $film->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('petugas.pemesanan.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemesanan List -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pemesanan</h6>
                </div>
                <div class="card-body">
                    @if($pemesanan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Pesanan</th>
                                        <th>Nama Pemesan</th>
                                        <th>Film</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Jam Tayang</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemesanan as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>#{{ $p->id }}</td>
                                        <td>{{ $p->user->name }}</td>
                                        <td>
                                            <strong>{{ $p->jadwal->film->judul }}</strong><br>
                                            <small class="text-muted">{{ $p->jadwal->film->genre }}</small>
                                        </td>
                                        <td>{{ $p->jumlah_tiket }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>{{ $p->jadwal->jam_tayang }}</td>
                                        <td class="text-success font-weight-bold">Rp {{ number_format($p->jadwal->harga_tiket * $p->jumlah_tiket, 0, ',', '.') }}</td>
                                        <td>
                                            @if($p->status == 'menunggu')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($p->status == 'dikonfirmasi')
                                                <span class="badge badge-success">Dikonfirmasi</span>
                                            @else
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($p->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($p->status == 'menunggu')
                                                <form action="{{ route('petugas.konfirmasi', $p->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pemesanan ini?')">
                                                        <i class="fas fa-check"></i> Konfirmasi
                                                    </button>
                                                </form>
                                                <form action="{{ route('petugas.batal', $p->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan pemesanan ini?')">
                                                        <i class="fas fa-times"></i> Batalkan
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-ticket-alt fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada pemesanan</h4>
                            <p class="text-muted">Belum ada pemesanan yang dibuat</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($pemesanan->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $pemesanan->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 