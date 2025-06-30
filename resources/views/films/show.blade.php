@extends('layouts.app')

@section('title', 'Detail Film')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detail Film</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>Judul:</strong> {{ $film->judul }}</p>
                <p><strong>Deskripsi:</strong> {{ $film->deskripsi }}</p>
                <p><strong>Genre:</strong> {{ $film->genre }}</p>
                <p><strong>Durasi:</strong> {{ $film->durasi }} menit</p>

                <a href="{{ route('films.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
@endsection
