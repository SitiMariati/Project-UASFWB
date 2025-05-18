<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pesanans = Pemesanan::all();
        return view('pemesanan.index', compact('pesanan'));
    }

    public function create()
    {
        return view('pemesanan.create');
    }

    public function store(Request $request)
    {
        Pemesanan::create($request->all());
        return redirect()->route('pemesanan.index');
    }

   
}
