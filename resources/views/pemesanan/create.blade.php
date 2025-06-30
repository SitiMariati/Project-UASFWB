@extends('layouts.app')

@section('title', 'Buat Pemesanan')

@section('content')
    <div class="container">
        <h1 class="mb-4">Buat Pemesanan</h1>

        <form action="{{ route('pemesanan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Film</label>
                <select name="film_id" class="form-control @error('film_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Film --</option>
                    @foreach ($films as $film)
                        <option value="{{ $film->id }}">{{ $film->judul }}</option>
                    @endforeach
                </select>
                @error('film_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Tiket</label>
                <input type="number" name="jumlah_tiket" class="form-control @error('jumlah_tiket') is-invalid @enderror" value="{{ old('jumlah_tiket') }}" required>
                @error('jumlah_tiket')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Tayang</label>
                <input type="date" name="tanggal_tayang" class="form-control @error('tanggal_tayang') is-invalid @enderror" value="{{ old('tanggal_tayang') }}" required>
                @error('tanggal_tayang')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="menunggu">Menunggu</option>
                    <option value="dikonfirmasi">Dikonfirmasi</option>
                    <option value="dibatalkan">Dibatalkan</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
