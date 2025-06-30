@extends('layouts.app')

@section('title', 'Dashboard Pengguna')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Pengguna</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Pesanan Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pesanan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPesanan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesanan Menunggu Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Menunggu Konfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pesananMenunggu }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesanan Dikonfirmasi Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Dikonfirmasi</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pesananDikonfirmasi }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Film Terbaru Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Film Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $filmTerbaru->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-film fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Pesanan Terbaru -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Terbaru</h6>
                </div>
                <div class="card-body">
                    @if($recentPesanan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Film</th>
                                        <th>Jumlah Tiket</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPesanan as $pesanan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pesanan->jadwal->film->judul }}</td>
                                        <td>{{ $pesanan->jumlah_tiket }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pesanan->jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>
                                            @if($pesanan->status == 'menunggu')
                                                <span class="badge badge-warning">Menunggu</span>
                                            @elseif($pesanan->status == 'dikonfirmasi')
                                                <span class="badge badge-success">Dikonfirmasi</span>
                                            @else
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('pengguna.pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Belum ada pesanan</h5>
                            <p class="text-muted">Mulai pesan tiket film favorit Anda</p>
                            <a href="{{ route('pengguna.jadwal') }}" class="btn btn-primary">
                                <i class="fas fa-calendar"></i> Lihat Jadwal
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Film Terbaru -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Film Terbaru</h6>
                </div>
                <div class="card-body">
                    @if($filmTerbaru->count() > 0)
                        @foreach($filmTerbaru as $film)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">{{ $film->judul }}</h6>
                                <p class="card-text small">{{ Str::limit($film->deskripsi, 80) }}</p>
                                <div class="mb-2">
                                    <span class="badge badge-info">{{ $film->genre }}</span>
                                    <span class="badge badge-secondary">{{ $film->durasi }} menit</span>
                                </div>
                                <a href="{{ route('pengguna.film.show', $film->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                                <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#beliTiketModal{{ $film->id }}">
                                    <i class="fas fa-ticket-alt"></i> Beli Tiket
                                </button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-film fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Belum ada film</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Beli Tiket untuk setiap film di dashboard -->
@foreach($filmTerbaru as $film)
<div class="modal fade" id="beliTiketModal{{ $film->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Beli Tiket - {{ $film->judul }}</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('pengguna.pemesanan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Informasi Film</h6>
                            <p><strong>Judul:</strong> {{ $film->judul }}</p>
                            <p><strong>Genre:</strong> {{ $film->genre }}</p>
                            <p><strong>Durasi:</strong> {{ $film->durasi }} menit</p>
                            <p><strong>Deskripsi:</strong> {{ $film->deskripsi }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Pilih Jadwal</h6>
                            <div class="form-group">
                                <label for="jadwal_id_{{ $film->id }}">Jadwal Tayang:</label>
                                <select name="jadwal_tayang_id" id="jadwal_id_{{ $film->id }}" class="form-control" required>
                                    <option value="">Pilih Jadwal</option>
                                    @foreach($film->jadwalTayang as $jadwal)
                                        @if($jadwal->tanggal_tayang >= now()->format('Y-m-d'))
                                            <option value="{{ $jadwal->id }}" data-harga="{{ $jadwal->harga_tiket }}">
                                                {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d/m/Y') }} - 
                                                {{ \Carbon\Carbon::parse($jadwal->jam_tayang)->format('H:i') }} - 
                                                Studio {{ $jadwal->studio }} - 
                                                Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="jumlah_tiket_{{ $film->id }}">Jumlah Tiket:</label>
                                <input type="number" name="jumlah_tiket" id="jumlah_tiket_{{ $film->id }}" class="form-control" min="1" max="10" value="1" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Total Harga:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" id="total_harga_{{ $film->id }}" class="form-control" readonly value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Beli Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
// Script untuk menghitung total harga pada dashboard
document.addEventListener('DOMContentLoaded', function() {
    const films = @json($filmTerbaru);
    
    films.forEach(function(film) {
        const modalId = 'beliTiketModal' + film.id;
        const modal = document.getElementById(modalId);
        
        if (modal) {
            const jadwalSelect = modal.querySelector('#jadwal_id_' + film.id);
            const jumlahTiketInput = modal.querySelector('#jumlah_tiket_' + film.id);
            const totalHargaInput = modal.querySelector('#total_harga_' + film.id);
            
            if (jadwalSelect && jumlahTiketInput && totalHargaInput) {
                function updateTotal() {
                    const selectedOption = jadwalSelect.options[jadwalSelect.selectedIndex];
                    const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
                    
                    if (selectedOption && selectedOption.dataset.harga) {
                        const hargaPerTiket = parseInt(selectedOption.dataset.harga);
                        const total = hargaPerTiket * jumlahTiket;
                        totalHargaInput.value = total.toLocaleString('id-ID');
                    } else {
                        totalHargaInput.value = '0';
                    }
                }
                
                jadwalSelect.addEventListener('change', updateTotal);
                jumlahTiketInput.addEventListener('input', updateTotal);
            }
        }
    });
});
</script>
@endpush
@endsection 