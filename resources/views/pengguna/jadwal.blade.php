@extends('layouts.app')

@section('title', 'Jadwal Tayang')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Tayang</h1>
    </div>

    <!-- Filter -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-body">
                    <form method="GET" action="{{ route('pengguna.jadwal') }}" class="row">
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <label for="tanggal">Tanggal:</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
                        </div>
                        <div class="col-md-4">
                            <label>&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('pengguna.jadwal') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jadwal List -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Jadwal Tayang</h6>
                </div>
                <div class="card-body">
                    @if($jadwalTayang->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Film</th>
                                        <th>Tanggal Tayang</th>
                                        <th>Jam Tayang</th>
                                        <th>Genre</th>
                                        <th>Durasi</th>
                                        <th>Harga Tiket</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwalTayang as $jadwal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $jadwal->film->judul }}</strong><br>
                                            <small class="text-muted">{{ Str::limit($jadwal->film->deskripsi, 50) }}</small>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                        <td>{{ $jadwal->jam_tayang }}</td>
                                        <td><span class="badge badge-info">{{ $jadwal->film->genre }}</span></td>
                                        <td>{{ $jadwal->film->durasi }} menit</td>
                                        <td class="text-success font-weight-bold">Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#beliTiketModal{{ $jadwal->id }}">
                                                <i class="fas fa-ticket-alt"></i> Beli Tiket
                                            </button>
                                            <a href="{{ route('pengguna.film.show', $jadwal->film->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i> Detail Film
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">Tidak ada jadwal tayang</h4>
                            <p class="text-muted">Coba ubah filter atau cek kembali nanti</p>
                            <a href="{{ route('pengguna.dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-tachometer-alt"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    @if($jadwalTayang->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $jadwalTayang->links() }}
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal Beli Tiket untuk setiap jadwal -->
@foreach($jadwalTayang as $jadwal)
<div class="modal fade" id="beliTiketModal{{ $jadwal->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Beli Tiket - {{ $jadwal->film->judul }}</h5>
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
                            <p><strong>Judul:</strong> {{ $jadwal->film->judul }}</p>
                            <p><strong>Genre:</strong> {{ $jadwal->film->genre }}</p>
                            <p><strong>Durasi:</strong> {{ $jadwal->film->durasi }} menit</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Jadwal Terpilih</h6>
                            <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d/m/Y') }}</p>
                            <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($jadwal->jam_tayang)->format('H:i') }}</p>
                            <p><strong>Studio:</strong> {{ $jadwal->studio }}</p>
                            <p><strong>Harga:</strong> Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    
                    <input type="hidden" name="jadwal_tayang_id" value="{{ $jadwal->id }}">
                    
                    <div class="form-group">
                        <label for="jumlah_tiket_{{ $jadwal->id }}">Jumlah Tiket:</label>
                        <input type="number" name="jumlah_tiket" id="jumlah_tiket_{{ $jadwal->id }}" class="form-control" min="1" max="10" value="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Total Harga:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" id="total_harga_{{ $jadwal->id }}" class="form-control" readonly value="{{ number_format($jadwal->harga_tiket, 0, ',', '.') }}">
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
// Script untuk menghitung total harga pada halaman jadwal
document.addEventListener('DOMContentLoaded', function() {
    const jadwalTayang = @json($jadwalTayang);
    
    jadwalTayang.forEach(function(jadwal) {
        const jumlahTiketInput = document.getElementById('jumlah_tiket_' + jadwal.id);
        const totalHargaInput = document.getElementById('total_harga_' + jadwal.id);
        
        if (jumlahTiketInput && totalHargaInput) {
            function updateTotal() {
                const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
                const hargaPerTiket = jadwal.harga_tiket;
                const total = hargaPerTiket * jumlahTiket;
                totalHargaInput.value = total.toLocaleString('id-ID');
            }
            
            jumlahTiketInput.addEventListener('input', updateTotal);
        }
    });
});
</script>
@endpush
@endsection 