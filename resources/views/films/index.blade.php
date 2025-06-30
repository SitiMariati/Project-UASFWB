@extends('layouts.app')

@section('title', 'Daftar Film')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Film</h1>

        <a href="{{ route('films.create') }}" class="btn btn-primary mb-3">Tambah Film</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Genre</th>
                    <th>Durasi (menit)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($films as $film)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $film->judul }}</td>
                        <td>{{ $film->deskripsi }}</td>
                        <td>{{ $film->genre }}</td>
                        <td>{{ $film->durasi }}</td>
                        <td>
                            <a href="{{ route('films.show', $film->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('films.edit', $film->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('films.destroy', $film->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data film.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
