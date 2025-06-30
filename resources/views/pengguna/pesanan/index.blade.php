@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Pesanan</h1>
    </div>

    <!-- Pesanan List -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
                </div>
                <div class="card-body">
                    @if($pesanan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
                                    @foreach($pesanan as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $p->jadwal->film->judul }}</strong><br>
                                            <small class="text-muted">{{ $p->jadwal->film->genre }}</small>
                                        </td>
                                        <td>{{ $p->jumlah_tiket }}</td>
                                        <td>{{ \Carbon\Carbon::parse($p->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>{{ $p->jadwal->jam_tayang }}</td>
                                        <td class="text-success font-weight-bold">
                                            @if($p->total_harga)
                                                Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                            @else
                                                Rp {{ number_format($p->jumlah_tiket * $p->jadwal->harga_tiket, 0, ',', '.') }}
                                            @endif
                                        </td>
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
                                            <a href="{{ route('pengguna.pesanan.show', $p->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                            @if($p->status == 'menunggu')
                                                <form action="{{ route('pengguna.pesanan.cancel', $p->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Batalkan pesanan ini?')">
                                                        <i class="fas fa-times"></i> Batal
                                                    </button>
                                                </form>
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
                            <h4 class="text-muted">Belum ada pesanan</h4>
                            <p class="text-muted">Mulai pesan tiket film favorit Anda</p>
                            <a href="{{ route('pengguna.jadwal') }}" class="btn btn-primary">
                                <i class="fas fa-calendar"></i> Lihat Jadwal
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($pesanan->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $pesanan->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 