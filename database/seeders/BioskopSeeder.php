<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BioskopSeeder extends Seeder
{
    public function run(): void
    {
        // Pengguna
        DB::table('pengguna')->insert([
            [
                'nama' => 'Admin Bioskop',
                'email' => 'admin@example.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'admin',
            ],
            [
                'nama' => 'Petugas Tiket',
                'email' => 'petugas@example.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'petugas',
            ],
            [
                'nama' => 'Pelanggan Umum',
                'email' => 'pelanggan@example.com',
                'kata_sandi' => Hash::make('password'),
                'peran' => 'pelanggan',
            ],
        ]);

        // Film
        DB::table('film')->insert([
            'judul' => 'Avengers: Endgame',
            'deskripsi' => 'Film superhero aksi dari Marvel.',
            'durasi' => 180,
            
        ]);
    }
}
