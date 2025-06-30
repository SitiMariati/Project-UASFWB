@extends('layouts.app')

@section('title', 'Tambah Film')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Film Baru</h1>
        <a href="{{ route('admin.film.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Film</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.film.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="judul">Judul Film <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" name="judul" value="{{ old('judul') }}" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="genre">Genre <span class="text-danger">*</span></label>
                    <select class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" required>
                        <option value="">Pilih Genre</option>
                        <option value="Action" {{ old('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                        <option value="Adventure" {{ old('genre') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                        <option value="Comedy" {{ old('genre') == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                        <option value="Drama" {{ old('genre') == 'Drama' ? 'selected' : '' }}>Drama</option>
                        <option value="Horror" {{ old('genre') == 'Horror' ? 'selected' : '' }}>Horror</option>
                        <option value="Romance" {{ old('genre') == 'Romance' ? 'selected' : '' }}>Romance</option>
                        <option value="Sci-Fi" {{ old('genre') == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                        <option value="Thriller" {{ old('genre') == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                        <option value="Animation" {{ old('genre') == 'Animation' ? 'selected' : '' }}>Animation</option>
                        <option value="Documentary" {{ old('genre') == 'Documentary' ? 'selected' : '' }}>Documentary</option>
                    </select>
                    @error('genre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="durasi">Durasi (menit) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('durasi') is-invalid @enderror" 
                           id="durasi" name="durasi" value="{{ old('durasi') }}" min="1" max="300" required>
                    @error('durasi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Film
                    </button>
                    <a href="{{ route('admin.film.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 