@extends('layouts.app')

@section('title', 'Daftar Film')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Film</h1>
    </div>

    <!-- Film List -->
    <div class="row">
        @if($films->count() > 0)
            @foreach($films as $film)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $film->judul }}</h5>
                        <p class="card-text">{{ Str::limit($film->deskripsi, 150) }}</p>
                        
                        <div class="mb-3">
                            <span class="badge badge-info">{{ $film->genre }}</span>
                            <span class="badge badge-secondary">{{ $film->durasi }} menit</span>
                        </div>
                        
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-calendar"></i> Ditambahkan: {{ \Carbon\Carbon::parse($film->created_at)->format('d/m/Y') }}
                            </small>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pengguna.film.show', $film->id) }}" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            <a href="{{ route('pengguna.jadwal') }}?film={{ $film->id }}" class="btn btn-success">
                                <i class="fas fa-calendar"></i> Jadwal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-film fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Belum ada film tersedia</h4>
                        <p class="text-muted">Film akan segera ditambahkan oleh admin</p>
                        <a href="{{ route('pengguna.dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-tachometer-alt"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($films->hasPages())
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-center">
                {{ $films->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection 