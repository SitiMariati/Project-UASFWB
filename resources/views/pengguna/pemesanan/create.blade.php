@extends('layouts.app')

@section('title', 'Pemesanan Tiket')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Pemesanan Tiket</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('pengguna.pemesanan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="jadwal_tayang_id">Pilih Jadwal Tayang</label>
                    <select name="jadwal_tayang_id" id="jadwal_tayang_id" class="form-control" required>
                        <option value="">-- Pilih Jadwal --</option>
                        @foreach($jadwalTayang as $jadwal)
                            <option value="{{ $jadwal->id }}">
                                {{ $jadwal->film->judul }} | {{ $jadwal->tanggal_tayang }} {{ $jadwal->jam_tayang }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_tiket">Jumlah Tiket</label>
                    <input type="number" name="jumlah_tiket" id="jumlah_tiket" class="form-control" min="1" value="1" required>
                </div>
                <button type="submit" class="btn btn-primary">Pesan Tiket</button>
            </form>
        </div>
    </div>
</div>
@endsection 