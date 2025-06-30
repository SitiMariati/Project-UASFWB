@extends('layouts.app')

@section('title', 'Daftar Pemesanan')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Pemesanan</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pemesanan.create') }}" class="btn btn-primary mb-3">Buat Pemesanan</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Film</th>
                    <th>Jumlah Tiket</th>
                    <th>Tanggal Tayang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemesanan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->film->judul }}</td>
                        <td>{{ $item->jumlah_tiket }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_tayang)->format('d-m-Y') }}</td>
                        <td>
                            @if ($item->status == 'menunggu')
                                <span class="badge text-bg-warning">Menunggu</span>
                            @elseif ($item->status == 'dikonfirmasi')
                                <span class="badge text-bg-success">Dikonfirmasi</span>
                            @else
                                <span class="badge text-bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('pemesanan.show', $item->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('pemesanan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('pemesanan.destroy', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus pemesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data pemesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
