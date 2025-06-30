@extends('layouts.app')

@section('title', 'Kelola Jadwal')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Jadwal Tayang</h1>
        <a href="{{ route('admin.jadwal.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Jadwal
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Jadwal List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Tayang</h6>
        </div>
        <div class="card-body">
            @if($jadwals->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Film</th>
                                <th>Tanggal Tayang</th>
                                <th>Jam Tayang</th>
                                <th>Harga Tiket</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $jadwal->film->judul }}</strong><br>
                                    <small class="text-muted">{{ $jadwal->film->genre }}</small>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal_tayang)->format('d/m/Y') }}</td>
                                <td>{{ $jadwal->jam_tayang }}</td>
                                <td class="text-success font-weight-bold">Rp {{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</td>
                                <td>
                                    @if(\Carbon\Carbon::parse($jadwal->tanggal_tayang . ' ' . $jadwal->jam_tayang)->isPast())
                                        <span class="badge badge-secondary">Selesai</span>
                                    @else
                                        <span class="badge badge-success">Akan Tayang</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            <i class="fas fa-trash"></i> Hapus
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
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada jadwal tayang</h4>
                    <p class="text-muted">Mulai tambahkan jadwal tayang pertama Anda</p>
                    <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Jadwal
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 