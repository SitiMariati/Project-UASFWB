<?php

namespace App\Http\Controllers;

use App\Models\Jadwal_tayang;
use App\Models\Film;
use Illuminate\Http\Request;

class JadwalTayangController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal_tayang::with('film')->get();
        return view('jadwal.index',compact('jadwal'));
    }
    public function create()
    {
        if (auth()->pengguna()->role !== 'admin') {
            abort(403);
        }
        $films = Film::all();
        return view('jadwal.create',compact('films'));
    }

    public function store(Request $request)
    {
        if (auth()->pengguna()->role !== 'admin'){
            abort(403);
        }
        $request->validate([
            'film_id' => 'required|exists:film,id',
            'tanggal' => 'required|date',
            'jam_tayang' => 'required|integer'
        ]);

        Jadwal_Tayang::create($request->all());
        return redirect()->route('jadwal_tayang.index')->with('success', 'Jadwal berhasil ditambahkan');

    }

    public function show(Jadwal_Tayang $jadwal_tayang)
    {
        return view('jadwal.show', compact('jadwal_tayang'));
    }

    public function edit(Jadwal_Tayang $jadwal_Tayang)
    {
        if (auth()->pelanggan()->role !== 'admin') {
            abort(403);
        }
        $films = Film::all();
        return view('jadwal.edit',compact('jadwal_tayang', 'films'));
    }

      public function update(Request $request, JadwalTayang $jadwal_tayang)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $jadwal_tayang->update($request->all());
        return redirect()->route('jadwal_tayang.index')->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy(JadwalTayang $jadwal_tayang)
    {
        if (auth()->pelanggan()->role !== 'admin') {
            abort(403);
        }

        $jadwal_tayang->delete();
        return redirect()->route('jadwal_tayang.index')->with('success', 'Jadwal berhasil dihapus');
    }
    
}
