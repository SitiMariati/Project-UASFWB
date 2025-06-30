@extends('layouts.app')

@section('title', 'Detail Film')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Film</h1>
        <a href="{{ route('pengguna.film.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Film Detail -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $film->judul }}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="text-primary mb-3">{{ $film->judul }}</h5>
                            <p class="mb-3">{{ $film->deskripsi }}</p>
                            
                            <div class="mb-3">
                                <span class="badge badge-info mr-2">{{ $film->genre }}</span>
                                <span class="badge badge-secondary">{{ $film->durasi }} menit</span>
                            </div>
                            
                            <div class="mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> Ditambahkan: {{ \Carbon\Carbon::parse($film->created_at)->format('d/m/Y H:i') }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="fas fa-film fa-5x text-primary mb-3"></i>
                                <h6 class="text-muted">Poster Film</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Jadwal Tayang</h6>
                </div>
                <div class="card-body">
                    @if($jadwalTayang->count() > 0)
                        @foreach($jadwalTayang as $jadwal)
                        <div class="border-bottom pb-2 mb-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d/m/Y') }}</strong><br>
                                    <small class="text-muted">{{ $jadwal->jam_tayang }}</small>
                                </div>
                                <div class="text-right">
                                    <div class="text-success font-weight-bold">Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</div>
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#beliTiketModal{{ $jadwal->id }}">
                                        <i class="fas fa-ticket-alt"></i> Beli Tiket
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-3">
                            <i class="fas fa-calendar-times fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-0">Belum ada jadwal tayang</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('pengguna.jadwal') }}?film={{ $film->id }}" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-calendar"></i> Lihat Jadwal Lengkap
                    </a>
                    <a href="{{ route('pengguna.film.index') }}" class="btn btn-secondary btn-block mb-2">
                        <i class="fas fa-film"></i> Semua Film
                    </a>
                    <a href="{{ route('pengguna.dashboard') }}" class="btn btn-info btn-block">
                        <i class="fas fa-tachometer-alt"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Beli Tiket untuk setiap jadwal -->
@foreach($jadwalTayang as $jadwal)
<div class="modal fade" id="beliTiketModal{{ $jadwal->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
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
// Script untuk menghitung total harga pada halaman detail film
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