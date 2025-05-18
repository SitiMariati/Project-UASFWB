<?php

namespace App\Http\Controllers;
use App\Models\Film;
use Illuminate\Http\Request;
class FilmController extends Controller
{
    public function index()
    {
        $film = Film::all();
        return view('film.index',compact('film'));
    }

    public function create()
    {
        return view('film.create');
    }

    public function store(Request $request)
    {
        Film::create($request->all());
        return redirect()->route('film.index');
    }
}
