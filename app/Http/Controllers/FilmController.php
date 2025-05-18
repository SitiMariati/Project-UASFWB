<?php

namespace App\Http\Controllers;

use App\Model\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = film::all();
        return view('film.index', compact('films'));
    }
    public function create()
    {
        if (auth()->pengguna()->role !== 'admin'){
            abort(403);
        }
        return view('film.create');
    }
    public function store(Request $request)
    {
        if (auth()->pengguna()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'judul' => 'required',
            'genre' => 'required',
            'durasi' => 'required|integer',
            'deskripsi' => 'requierd'
        ]);
        Film::create($request->all());
        return redirect()->route('film.index')->with('succes', 'Film berhasil ditambahkan');
    }
    public function show(Film $film)
    {
        return view('film.show',compact('film'));
    }
    public function edit(Film $film)
    {
        if (auth()->pengguna()->role !== 'admin') {
            abort(403);
        }
        return view('film.edit', compact('film'));
    }
    public function update(Request $request, Film $film)
    {
        if (auth()->pengguna()->role !== 'admin') {
            abort(403);
        }
        $film->update($request->all());
        return redirect()->route('film.index')->with('success','Film berhasil diupdate');
    }
    public function destory(Film $film)
    {
        if (auth()->pengguna()->role !== 'admin'){
            abort(403);
        }
        $film->Delete();
        return redirect()->route('film.index')->with('success','Film berhasil dihapus');
    }
}
