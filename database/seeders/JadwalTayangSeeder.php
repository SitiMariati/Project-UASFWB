<?php

namespace Database\Seeders;

use App\Models\JadwalTayang;
use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class JadwalTayangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = Film::all();
        
        foreach ($films as $film) {
            // Jadwal untuk hari ini
            JadwalTayang::create([
                'film_id' => $film->id,
                'tanggal_tayang' => Carbon::today(),
                'jam_tayang' => '14:00',
                'studio' => 'Studio 1',
                'harga_tiket' => 35000,
            ]);
            
            JadwalTayang::create([
                'film_id' => $film->id,
                'tanggal_tayang' => Carbon::today(),
                'jam_tayang' => '17:00',
                'studio' => 'Studio 2',
                'harga_tiket' => 40000,
            ]);
            
            // Jadwal untuk besok
            JadwalTayang::create([
                'film_id' => $film->id,
                'tanggal_tayang' => Carbon::tomorrow(),
                'jam_tayang' => '15:30',
                'studio' => 'Studio 1',
                'harga_tiket' => 35000,
            ]);
            
            JadwalTayang::create([
                'film_id' => $film->id,
                'tanggal_tayang' => Carbon::tomorrow(),
                'jam_tayang' => '19:30',
                'studio' => 'Studio 2',
                'harga_tiket' => 40000,
            ]);
            
            // Jadwal untuk 3 hari ke depan
            JadwalTayang::create([
                'film_id' => $film->id,
                'tanggal_tayang' => Carbon::today()->addDays(3),
                'jam_tayang' => '16:00',
                'studio' => 'Studio 1',
                'harga_tiket' => 35000,
            ]);
            
            JadwalTayang::create([
                'film_id' => $film->id,
                'tanggal_tayang' => Carbon::today()->addDays(3),
                'jam_tayang' => '20:00',
                'studio' => 'Studio 2',
                'harga_tiket' => 40000,
            ]);
        }
    }
}
