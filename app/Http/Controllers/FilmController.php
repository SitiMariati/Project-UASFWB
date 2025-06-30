<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\JadwalTayang;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    // Dashboard Pengguna
    public function dashboard()
    {
        $user = Auth::user();
        $totalPesanan = Pemesanan::where('user_id', $user->id)->count();
        $pesananMenunggu = Pemesanan::where('user_id', $user->id)->where('status', 'menunggu')->count();
        $pesananDikonfirmasi = Pemesanan::where('user_id', $user->id)->where('status', 'dikonfirmasi')->count();
        
        $recentPesanan = Pemesanan::with(['jadwal.film'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();
            
        $filmTerbaru = Film::with('jadwalTayang')->latest()->take(4)->get();
        
        return view('pengguna.dashboard', compact('totalPesanan', 'pesananMenunggu', 'pesananDikonfirmasi', 'recentPesanan', 'filmTerbaru'));
    }

    // Menampilkan semua film untuk pengguna
    public function index()
    {
        $films = Film::with('jadwalTayang')->paginate(12);
        return view('pengguna.film.index', compact('films'));
    }

    // Menampilkan detail film untuk pengguna
    public function show(Film $film)
    {
        $jadwalTayang = JadwalTayang::with('film')
            ->where('film_id', $film->id)
            ->whereDate('tanggal_tayang', '>=', today())
            ->orderBy('tanggal_tayang')
            ->get();
            
        return view('pengguna.film.show', compact('film', 'jadwalTayang'));
    }

    // Method untuk admin (tidak digunakan untuk pengguna)
    public function create()
    {
        return view('films.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'genre' => 'required',
            'durasi' => 'required|integer'
        ]);

        Film::create($request->all());

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'genre' => 'required',
            'durasi' => 'required|integer'
        ]);

        $film->update($request->all());

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy(Film $film)
    {
        $film->delete();

        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus.');
    }
}
