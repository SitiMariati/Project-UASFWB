<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pemesanan;

class UpdatePemesananTotalHargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pemesanans = Pemesanan::with('jadwal')->get();
        
        foreach ($pemesanans as $pemesanan) {
            if (!$pemesanan->total_harga && $pemesanan->jadwal) {
                $totalHarga = $pemesanan->jumlah_tiket * $pemesanan->jadwal->harga_tiket;
                $pemesanan->update(['total_harga' => $totalHarga]);
                echo "Updated pemesanan ID {$pemesanan->id}: {$pemesanan->jumlah_tiket} x Rp {$pemesanan->jadwal->harga_tiket} = Rp {$totalHarga}\n";
            }
        }
        
        echo "Total harga update completed!\n";
    }
}
