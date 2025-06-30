<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\JadwalTayang;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    // Dashboard Petugas
    public function dashboard()
    {
        $totalPemesanan = Pemesanan::count();
        $pemesananMenunggu = Pemesanan::where('status', 'menunggu')->count();
        $pemesananDikonfirmasi = Pemesanan::where('status', 'dikonfirmasi')->count();
        $pemesananDibatalkan = Pemesanan::where('status', 'dibatalkan')->count();
        
        $recentPemesanan = Pemesanan::with(['user', 'jadwal.film'])
            ->latest()
            ->take(10)
            ->get();
            
        return view('petugas.dashboard', compact('totalPemesanan', 'pemesananMenunggu', 'pemesananDikonfirmasi', 'pemesananDibatalkan', 'recentPemesanan'));
    }

    // Home Petugas
    public function home()
    {
        $pemesananMenunggu = Pemesanan::with(['user', 'jadwal.film'])
            ->where('status', 'menunggu')
            ->latest()
            ->take(5)
            ->get();
            
        $jadwalHariIni = JadwalTayang::with('film')
            ->whereDate('tanggal_tayang', today())
            ->get();
            
        return view('petugas.home', compact('pemesananMenunggu', 'jadwalHariIni'));
    }

    // Kelola Tiket
    public function tiketIndex()
    {
        $pemesanans = Pemesanan::with(['user', 'jadwal.film'])
            ->where('status', 'dikonfirmasi')
            ->latest()
            ->get();
            
        return view('petugas.tiket.index', compact('pemesanans'));
    }

    public function scanTiket(Request $request)
    {
        $query = Pemesanan::with(['user', 'jadwal.film']);
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereHas('jadwal', function($q) use ($request) {
                $q->whereDate('tanggal_tayang', $request->tanggal);
            });
        }
        
        // Filter berdasarkan film
        if ($request->filled('film')) {
            $query->whereHas('jadwal', function($q) use ($request) {
                $q->where('film_id', $request->film);
            });
        }
        
        $transactions = $query->latest()->paginate(15);
        
        // Data untuk filter
        $films = \App\Models\Film::all();
        
        return view('petugas.tiket.scan', compact('transactions', 'films'));
    }

    // Menampilkan semua pemesanan
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'jadwal.film']);
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereHas('jadwal', function($q) use ($request) {
                $q->whereDate('tanggal_tayang', $request->tanggal);
            });
        }
        
        // Filter berdasarkan film
        if ($request->filled('film')) {
            $query->whereHas('jadwal', function($q) use ($request) {
                $q->where('film_id', $request->film);
            });
        }
        
        $pemesanan = $query->latest()->paginate(15);
        
        // Data untuk filter
        $films = \App\Models\Film::all();
        
        return view('petugas.pemesanan.index', compact('pemesanan', 'films'));
    }

    // Menampilkan detail pemesanan
    public function show($id)
    {
        $pemesanan = Pemesanan::with(['user', 'jadwal.film'])->findOrFail($id);
        return view('petugas.pemesanan.show', compact('pemesanan'));
    }

    // Konfirmasi status pemesanan
    public function konfirmasi($id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = 'dikonfirmasi';
        $pemesanan->save();

        return redirect()->route('petugas.pemesanan.index')->with('success', 'Pemesanan berhasil dikonfirmasi.');
    }

    // Batalkan pemesanan
    public function batal($id)
    { 
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status = 'dibatalkan';
        $pemesanan->save();

        return redirect()->route('petugas.pemesanan.index')->with('success', 'Pemesanan berhasil dibatalkan.');
    }

    // Cek Jadwal Tayang
    public function jadwalIndex()
    {
        $jadwalTayang = JadwalTayang::with('film')
            ->whereDate('tanggal_tayang', '>=', today())
            ->orderBy('tanggal_tayang')
            ->get();
            
        return view('petugas.jadwal.index', compact('jadwalTayang'));
    }

    // Update status tiket
    public function updateTiketStatus(Request $request, $id)
    {
        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->status_tiket = $request->status_tiket;
        $pemesanan->save();

        return redirect()->route('petugas.tiket.index')->with('success', 'Status tiket berhasil diperbarui.');
    }
}
