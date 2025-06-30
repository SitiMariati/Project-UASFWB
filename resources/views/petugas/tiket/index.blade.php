@extends('layouts.app')

@section('title', 'Kelola Tiket - Petugas')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Tiket</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tiket yang Sudah Dikonfirmasi</h6>
                </div>
                <div class="card-body">
                    @if($pemesanans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Tiket</th>
                                        <th>Nama Pemesan</th>
                                        <th>Film</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Jam Tayang</th>
                                        <th>Studio</th>
                                        <th>Total Harga</th>
                                        <th>Status Tiket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pemesanans as $pemesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>#{{ $pemesanan->id }}</strong>
                                        </td>
                                        <td>{{ $pemesanan->user->name }}</td>
                                        <td>
                                            <strong>{{ $pemesanan->jadwal->film->judul }}</strong><br>
                                            <small class="text-muted">{{ $pemesanan->jadwal->film->genre }}</small>
                                        </td>
                                        <td>{{ $pemesanan->jumlah_tiket }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pemesanan->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pemesanan->jadwal->jam_tayang)->format('H:i') }}</td>
                                        <td>{{ $pemesanan->jadwal->studio }}</td>
                                        <td class="text-success font-weight-bold">Rp {{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($pemesanan->status_tiket == 'valid')
                                                <span class="badge badge-success">Valid</span>
                                            @elseif($pemesanan->status_tiket == 'tertunda')
                                                <span class="badge badge-warning">Tertunda</span>
                                            @elseif($pemesanan->status_tiket == 'batal')
                                                <span class="badge badge-danger">Batal</span>
                                            @else
                                                <span class="badge badge-info">Belum Digunakan</span>
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
                            <h4 class="text-muted">Tidak ada tiket</h4>
                            <p class="text-muted">Belum ada tiket yang dikonfirmasi</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 