<?php

namespace App\Http\Controllers;

use App\Models\JadwalTayang;
use Illuminate\Http\Request;

class JadwaTayangController extends Controller
{
    public function index()
    {
        $JadwalTayang = JadwalTayang::all();
        return view('JadwalTayang.index',compact('JadwalTayang'));
    }

    public function create()
    {
        return view('JadwalTayang.create');
    }

    public function store(Request $request)
    {
        JadwalTayang::create($request->all());
        return redirect()->route('JadwalTayang.index');
    }
}
