@extends('layouts.app')

@section('title', 'Kelola Film')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Film</h1>
        <a href="{{ route('admin.film.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Film
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

    <!-- Film List -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Film</h6>
        </div>
        <div class="card-body">
            @if($films->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Genre</th>
                                <th>Durasi</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($films as $film)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $film->judul }}</strong>
                                </td>
                                <td>
                                    <span class="badge badge-info">{{ $film->genre }}</span>
                                </td>
                                <td>{{ $film->durasi }} menit</td>
                                <td>{{ Str::limit($film->deskripsi, 100) }}</td>
                                <td>{{ \Carbon\Carbon::parse($film->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.film.edit', $film->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.film.destroy', $film->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus film ini?')">
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
                    <i class="fas fa-film fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada film</h4>
                    <p class="text-muted">Mulai tambahkan film pertama Anda</p>
                    <a href="{{ route('admin.film.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Film
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 