<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
   
    public function run(): void
    {
         Film::create([
            'judul' => 'The conjuring',
            'deskripsi' => 'Berdasarkan kisah nyata pasangan paranormal Ed dan Lorraine Warren yang membantu sebuah keluarga melawan roh jahat yang menghantui rumah tua mereka. ',
            'genre' => ('horor'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
