@extends('layouts.app')
@section('content')
<h2>Daftar Film</h2>
@if (Auth::pengguna()->role == 'admin')
    <a href="{{ route('film.create') }}" class="btn btn-primary">Tambah Film</a>
    @endif
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Genre</th>
                <th>Durasi</th>
                <th>Deskripsi</th>
                @if (Auth::pengguna()->role == 'admin')
                 <th>Aksi</th>   
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $film)
            <tr>
                <td>{{ $film->judul}}</td>
                <td>{{ $film->genre}}</td>
                <td>{{ $film->durasi}} menit</td>
                <td>{{ $film->deskripsi}}</td>
                @if (Auth::pengguna()->role == 'admin')
                <td>
                    <a href="{{ route('film.edit', $film->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('film.destroy', $film->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endsection
