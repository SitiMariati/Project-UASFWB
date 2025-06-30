<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\JadwalTayang;
use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    // Menampilkan jadwal tayang untuk pengguna
    public function jadwalIndex()
    {
        $films = Film::all();
        $jadwalTayang = JadwalTayang::with('film')
            ->whereDate('tanggal_tayang', '>=', today())
            ->orderBy('tanggal_tayang')
            ->orderBy('jam_tayang')
            ->paginate(10);
            
        // Filter berdasarkan request
        if (request('film')) {
            $jadwalTayang = JadwalTayang::with('film')
                ->where('film_id', request('film'))
                ->whereDate('tanggal_tayang', '>=', today())
                ->orderBy('tanggal_tayang')
                ->orderBy('jam_tayang')
                ->paginate(10);
        }
        
        if (request('tanggal')) {
            $jadwalTayang = JadwalTayang::with('film')
                ->whereDate('tanggal_tayang', request('tanggal'))
                ->orderBy('jam_tayang')
                ->paginate(10);
        }
            
        return view('pengguna.jadwal', compact('jadwalTayang', 'films'));
    }

    // Menampilkan riwayat pesanan pengguna
    public function myOrders()
    {
        $pesanan = Pemesanan::with('jadwal.film')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('pengguna.pesanan.index', compact('pesanan'));
    }

    // Menampilkan detail pesanan
    public function show($id)
    {
        $pesanan = Pemesanan::with(['jadwal.film', 'pembayaran'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);
        return view('pengguna.pesanan.show', compact('pesanan'));
    }

    // Membatalkan pesanan
    public function cancel($id)
    {
        $pesanan = Pemesanan::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->findOrFail($id);
            
        $pesanan->update(['status' => 'dibatalkan']);
        
        return redirect()->route('pengguna.pesanan.index')->with('success', 'Pesanan berhasil dibatalkan');
    }

    // Method untuk admin/petugas
    public function index()
    {
        $jadwals = JadwalTayang::with('film')->get();
        return view('pemesanan.index', compact('jadwals'));
    }

    public function store(Request $request){
        $request->validate([
            'jadwal_tayang_id' => 'required|exists:jadwal_tayangs,id',
            'jumlah_tiket' => 'required|integer|min:1'
        ]);

        // Ambil jadwal untuk mendapatkan harga tiket
        $jadwal = JadwalTayang::findOrFail($request->jadwal_tayang_id);
        $totalHarga = $request->jumlah_tiket * $jadwal->harga_tiket;

        Pemesanan::create([
            'user_id' => Auth::id(),
            'jadwal_tayang_id' => $request->jadwal_tayang_id,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $totalHarga,
            'status' => 'menunggu'
        ]);

        return redirect()->route('pengguna.pesanan.index')->with('success', 'Pemesanan berhasil!');
    }

    // Form pemesanan tiket untuk pengguna
    public function create()
    {
        $jadwalTayang = JadwalTayang::with('film')
            ->whereDate('tanggal_tayang', '>=', today())
            ->orderBy('tanggal_tayang')
            ->orderBy('jam_tayang')
            ->get();
        return view('pengguna.pemesanan.create', compact('jadwalTayang'));
    }
}




