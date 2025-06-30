<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'petugas',
        ]);
        User::create([
            'name' => 'Pengguna',
            'email' => 'pengguna@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'pengguna',
        ]);
    }
}
