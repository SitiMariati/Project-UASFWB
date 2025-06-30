@extends('layouts.app')

@section('title', 'Transaksi - Petugas')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaksi Pemesanan</h1>
    </div>

    <!-- Filter -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form method="GET" action="{{ route('petugas.tiket.scan') }}" class="row">
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
                                <a href="{{ route('petugas.tiket.scan') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaksi List -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                </div>
                <div class="card-body">
                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Transaksi</th>
                                        <th>Nama Pemesan</th>
                                        <th>Film</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Jam Tayang</th>
                                        <th>Studio</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Status Tiket</th>
                                        <th>Tanggal Transaksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>#{{ $transaction->id }}</strong>
                                        </td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>
                                            <strong>{{ $transaction->jadwal->film->judul }}</strong><br>
                                            <small class="text-muted">{{ $transaction->jadwal->film->genre }}</small>
                                        </td>
                                        <td>{{ $transaction->jumlah_tiket }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->jadwal->jam_tayang)->format('H:i') }}</td>
                                        <td>{{ $transaction->jadwal->studio }}</td>
                                        <td class="text-success font-weight-bold">Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($transaction->status == 'menunggu')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($transaction->status == 'dikonfirmasi')
                                                <span class="badge badge-success">Dikonfirmasi</span>
                                            @else
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->status_tiket == 'valid')
                                                <span class="badge badge-success">Valid</span>
                                            @elseif($transaction->status_tiket == 'tertunda')
                                                <span class="badge badge-warning">Tertunda</span>
                                            @elseif($transaction->status_tiket == 'batal')
                                                <span class="badge badge-danger">Batal</span>
                                            @else
                                                <span class="badge badge-info">Belum Digunakan</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-receipt fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada transaksi</h4>
                            <p class="text-muted">Belum ada transaksi yang dibuat</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($transactions->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 