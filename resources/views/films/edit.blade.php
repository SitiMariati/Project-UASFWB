@extends('layouts.app')

@section('title', 'Edit Film')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Film</h1>

        <form action="{{ route('films.update', $film->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $film->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $film->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" name="genre" class="form-control @error('genre') is-invalid @enderror" value="{{ old('genre', $film->genre) }}" required>
                @error('genre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Durasi (menit)</label>
                <input type="number" name="durasi" class="form-control @error('durasi') is-invalid @enderror" value="{{ old('durasi', $film->durasi) }}" required>
                @error('durasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('films.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
