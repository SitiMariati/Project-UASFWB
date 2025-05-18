<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;
use App\Models\User_profiles;
use App\Models\Film;
use App\Models\Jadwal_tayang;
use App\Models\Pesanan;

class BioskopSeeder extends Seeder
{
    public function run(): void
    {
        // Buat pengguna admin
        $admin = Pengguna::create([
            'nama' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $adminProfile = User_profiles::create([
            'pengguna_id' => $admin->id,
            'alamat' => 'Jl. Admin Raya No.1',
            'no_hp' => '081234567890',
            'tanggal_lahir' => '1990-01-01',
        ]);

        // Buat pengguna biasa
        $pengguna = Pengguna::create([
            'nama' => 'Pengguna Satu',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'pengguna',
        ]);

        $penggunaProfile = User_profiles::create([
            'pengguna_id' => $pengguna->id,
            'alamat' => 'Jl. Pengguna Indah No.2',
            'no_hp' => '082345678901',
            'tanggal_lahir' => '1995-05-05',
        ]);

        // Buat film
        $film = Film::create([
            'judul' => 'Contoh Film Menegangkan',
            'genre' => 'Thriller',
            'durasi' => 120,
            'deskripsi' => 'Film yang penuh ketegangan dan misteri.',
        ]);

        // Relasi many-to-many film-pengguna
        $admin->films()->attach($film->id);

        // Buat jadwal tayang
        $jadwal = Jadwal_tayang::create([
            'film_id' => $film->id,
            'tanggal' => now()->toDateString(),
            'jam_tayang' => '19:00:00',
            'harga' => 50000,
        ]);

        // Buat pesanan
        Pesanan::create([
            'user_profiles_id' => $penggunaProfile->id,
            'jadwal_tayang_id' => $jadwal->id,
            'jumlah_tiket' => 2,
            'total_harga' => 100000,
            'status' => 'menunggu',
        ]);
    }
}
