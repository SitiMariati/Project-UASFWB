<?php

namespace Database\Seeders;

use App\Models\Film;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $films = [
            [
                'judul' => 'Avengers: Endgame',
                'deskripsi' => 'Setelah peristiwa yang menghancurkan di Avengers: Infinity War, alam semesta dalam reruntuhan. Dengan bantuan sisa Avengers, tim harus berkumpul sekali lagi untuk membalikkan tindakan Thanos dan mengembalikan keseimbangan alam semesta.',
                'genre' => 'Action',
                'durasi' => 181,
            ],
            [
                'judul' => 'The Lion King',
                'deskripsi' => 'Simba, seorang pangeran singa muda, harus menghadapi tragedi dan mengambil tanggung jawab untuk memulihkan kerajaan ayahnya dari tangan pamannya yang jahat.',
                'genre' => 'Animation',
                'durasi' => 118,
            ],
            [
                'judul' => 'Joker',
                'deskripsi' => 'Di Gotham City, Arthur Fleck yang terpinggirkan dan terabaikan berjuang untuk terhubung dengan orang lain. Ketika dia ditolak oleh masyarakat, dia mulai perjalanan menuju kehidupan kriminal.',
                'genre' => 'Drama',
                'durasi' => 122,
            ],
            [
                'judul' => 'Spider-Man: No Way Home',
                'deskripsi' => 'Peter Parker meminta bantuan Doctor Strange untuk membuat dunia melupakan bahwa dia adalah Spider-Man, tetapi ketika mantra berjalan salah, dia harus menghadapi musuh dari alam semesta lain.',
                'genre' => 'Action',
                'durasi' => 148,
            ],
            [
                'judul' => 'Frozen II',
                'deskripsi' => 'Elsa, Anna, Kristoff, dan Olaf melakukan perjalanan ke hutan ajaib untuk mengungkap kebenaran tentang masa lalu kerajaan mereka dan menyelamatkan Arendelle.',
                'genre' => 'Animation',
                'durasi' => 103,
            ],
        ];

        foreach ($films as $film) {
            Film::create($film);
        }
    }
}
