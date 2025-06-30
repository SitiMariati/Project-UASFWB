<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function form($pemesanan_id)
    {
        $pemesanan = Pemesanan::findOrFail($pemesanan_id);
        return view('pengguna.pembayaran', compact('pemesanan'));
    }

    public function proses(Request $request, $pemesanan_id)
    {
        $request->validate([
            'metode_pembayaran' => 'required|string',
            'jumlah_bayar' => 'required|numeric|min:1',
        ]);

        DB::beginTransaction();

        try {
            $pemesanan = Pemesanan::findOrFail($pemesanan_id);

            // Update status pemesanan ke "dikonfirmasi"
            $pemesanan->update(['status' => 'dikonfirmasi']);

            // Buat pembayaran
            Pembayaran::create([
                'pesanan_id' => $pemesanan->id,
                'metode_pembayaran' => $request->metode_pembayaran,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            DB::commit();

            return redirect()->route('pengguna.dashboard')->with('success', 'Pembayaran berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('Terjadi kesalahan saat memproses pembayaran.');
        }
    }
}

