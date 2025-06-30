<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SetupController extends Controller
{
    public function createAdmin()
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create Petugas User
        User::updateOrCreate(
            ['email' => 'petugas@petugas.com'],
            [
                'name' => 'Petugas Bioskop',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
            ]
        );

        // Create Pengguna User
        User::updateOrCreate(
            ['email' => 'pengguna@pengguna.com'],
            [
                'name' => 'Pengguna Test',
                'password' => Hash::make('pengguna123'),
                'role' => 'pengguna',
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Users created successfully!',
            'credentials' => [
                'admin' => ['email' => 'admin@admin.com', 'password' => 'admin123'],
                'petugas' => ['email' => 'petugas@petugas.com', 'password' => 'petugas123'],
                'pengguna' => ['email' => 'pengguna@pengguna.com', 'password' => 'pengguna123'],
            ]
        ]);
    }
} 