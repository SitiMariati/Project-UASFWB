@extends('layouts.app')

@section('title', 'Cek Jadwal - Petugas')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cek Jadwal Tayang</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jadwal Tayang Film</h6>
                </div>
                <div class="card-body">
                    @if($jadwalTayang->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Film</th>
                                        <th>Genre</th>
                                        <th>Durasi</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Jam Tayang</th>
                                        <th>Studio</th>
                                        <th>Harga Tiket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalTayang as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $jadwal->film->judul }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($jadwal->film->deskripsi, 50) }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $jadwal->film->genre }}</span>
                                        </td>
                                        <td>{{ $jadwal->film->durasi }} menit</td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->jam_tayang)->format('H:i') }}</td>
                                        <td>{{ $jadwal->studio }}</td>
                                        <td>Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Tidak ada jadwal tayang</h5>
                            <p class="text-muted">Belum ada jadwal tayang yang tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 