<?php

namespace Database\Seeders;

use App\Models\JadwalTayang;
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
           JadwalTayang::create([
            'film_id' => 1, // pastikan film dengan ID 1 ada di tabel films
            'waktu_tayang' => Carbon::create(2025, 5, 27, 19, 30),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
