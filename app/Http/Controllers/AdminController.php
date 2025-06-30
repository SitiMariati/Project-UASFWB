<?php

namespace App\Http\Controllers;
use App\Models\Film;
use App\Models\JadwalTayang;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard Admin
    public function dashboard()
    {
        $totalFilms = Film::count();
        $totalJadwal = JadwalTayang::count();
        $totalPemesanan = Pemesanan::count();
        $totalUsers = User::count();
        
        $recentPemesanan = Pemesanan::with(['user', 'jadwal.film'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact('totalFilms', 'totalJadwal', 'totalPemesanan', 'totalUsers', 'recentPemesanan'));
    }

    // Home Admin
    public function home()
    {
        $films = Film::latest()->take(6)->get();
        $jadwals = JadwalTayang::with('film')->latest()->take(5)->get();
        
        return view('admin.home', compact('films', 'jadwals'));
    }

    // Laporan
    public function laporan()
    {
        $totalPendapatan = Pemesanan::where('status', 'dikonfirmasi')->count() * 50000; // Asumsi harga tiket 50k
        $pemesananPerBulan = Pemesanan::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('bulan')
            ->get();
            
        $filmTerpopuler = Film::withCount('jadwalTayang')
            ->orderBy('jadwal_tayang_count', 'desc')
            ->take(5)
            ->get();
            
        return view('admin.laporan', compact('totalPendapatan', 'pemesananPerBulan', 'filmTerpopuler'));
    }

    // CRUD Film
    public function filmIndex()
    {
        $films = Film::all();
        return view('admin.film.index', compact('films'));
    }

    public function filmCreate()
    {
        return view('admin.film.create');
    }

    public function filmStore(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'genre' => 'required',
            'durasi' => 'required|integer'
        ]);

        Film::create($request->all());

        return redirect()->route('admin.film.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function filmEdit($id)
    {
        $film = Film::findOrFail($id);
        return view('admin.film.edit', compact('film'));
    }

    public function filmUpdate(Request $request, $id)
    {
        $film = Film::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'genre' => 'required',
            'durasi' => 'required|integer'
        ]);

        $film->update($request->all());

        return redirect()->route('admin.film.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function filmDestroy($id)
    {
        $film = Film::findOrFail($id);
        $film->delete();

        return redirect()->route('admin.film.index')->with('success', 'Film berhasil dihapus.');
    }

    // CRUD Jadwal
    public function jadwalIndex()
    {
        $jadwals = JadwalTayang::with('film')->get();
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function jadwalCreate()
    {
        $films = Film::all();
        return view('admin.jadwal.create', compact('films'));
    }

    public function jadwalStore(Request $request)
    {
        $request->validate([
            'film_id' => 'required|exists:films,id',
            'tanggal_tayang' => 'required|date',
            'jam_tayang' => 'required',
            'harga_tiket' => 'r equired|numeric'
        ]);

        JadwalTayang::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function jadwalEdit($id)
    {
        $jadwal = JadwalTayang::findOrFail($id);
        $films = Film::all();
        return view('admin.jadwal.edit', compact('jadwal', 'films'));
    }

    public function jadwalUpdate(Request $request, $id)
    {
        $jadwal = JadwalTayang::findOrFail($id);

        $request->validate([
            'film_id' => 'required|exists:films,id',
            'tanggal_tayang' => 'required|date',
            'jam_tayang' => 'required',
            'harga_tiket' => 'required|numeric'
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function jadwalDestroy($id)
    {
        $jadwal = JadwalTayang::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    // Transaksi Pemesanan
    public function transaksiIndex() {
        $pemesanan = Pemesanan::with(['user', 'jadwal.film'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Hitung total pendapatan dari pemesanan yang dikonfirmasi
        $totalPendapatan = $pemesanan->where('status', 'dikonfirmasi')
            ->sum(function($pesan) {
                return $pesan->jumlah_tiket * $pesan->jadwal->harga_tiket;
            });
            
        // Hitung total pemesanan per status
        $totalMenunggu = $pemesanan->where('status', 'menunggu')->count();
        $totalDikonfirmasi = $pemesanan->where('status', 'dikonfirmasi')->count();
        $totalDibatalkan = $pemesanan->where('status', 'dibatalkan')->count();
        
        return view('admin.transaksi.index', compact('pemesanan', 'totalPendapatan', 'totalMenunggu', 'totalDikonfirmasi', 'totalDibatalkan'));
    }

    // Role Management
    public function roleIndex() {
        $users = \App\Models\User::all();
        return view('admin.role.index', compact('users'));
    }

    public function roleUpdate(Request $request, $id) {
        $user = \App\Models\User::findOrFail($id);
        $user->update(['role' => $request->role]);
        return redirect()->route('admin.role.index')->with('success', 'Role berhasil diubah');
    }
}
