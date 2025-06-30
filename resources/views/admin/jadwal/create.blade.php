@extends('layouts.app')

@section('title', 'Tambah Jadwal')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jadwal Tayang</h1>
        <a href="{{ route('admin.jadwal.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- Form -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Jadwal</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.jadwal.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="film_id">Film <span class="text-danger">*</span></label>
                    <select class="form-control @error('film_id') is-invalid @enderror" id="film_id" name="film_id" required>
                        <option value="">Pilih Film</option>
                        @foreach($films as $film)
                            <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                {{ $film->judul }} ({{ $film->genre }})
                            </option>
                        @endforeach
                    </select>
                    @error('film_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_tayang">Tanggal Tayang <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_tayang') is-invalid @enderror" 
                           id="tanggal_tayang" name="tanggal_tayang" value="{{ old('tanggal_tayang') }}" required>
                    @error('tanggal_tayang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jam_tayang">Jam Tayang <span class="text-danger">*</span></label>
                    <input type="time" class="form-control @error('jam_tayang') is-invalid @enderror" 
                           id="jam_tayang" name="jam_tayang" value="{{ old('jam_tayang') }}" required>
                    @error('jam_tayang')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="harga_tiket">Harga Tiket (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('harga_tiket') is-invalid @enderror" 
                           id="harga_tiket" name="harga_tiket" value="{{ old('harga_tiket') }}" min="1000" step="1000" required>
                    @error('harga_tiket')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Jadwal
                    </button>
                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 