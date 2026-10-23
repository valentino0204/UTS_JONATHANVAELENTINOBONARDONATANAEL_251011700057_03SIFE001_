<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            ['Inception', 'Sci-Fi', 148, 2010, 'Seorang pencuri yang mencuri rahasia lewat mimpi diberi tugas menanamkan ide ke pikiran seorang CEO.', 'inception.jpg'],
            ['The Dark Knight', 'Action', 152, 2008, 'Batman menghadapi Joker yang membawa kekacauan ke Kota Gotham.', 'the-dark-knight.jpg'],
            ['Interstellar', 'Sci-Fi', 169, 2014, 'Sekelompok astronot menjelajahi lubang cacing demi mencari planet baru bagi umat manusia.', 'interstellar.jpg'],
            ['Parasite', 'Thriller', 132, 2019, 'Keluarga miskin menyusup ke dalam kehidupan keluarga kaya dengan konsekuensi tak terduga.', 'parasite.jpg'],
            ['Your Name', 'Animation', 106, 2016, 'Dua remaja yang tidak saling kenal tiba-tiba bertukar tubuh dan terhubung dengan cara misterius.', 'your-name.jpg'],
            ['The Godfather', 'Crime', 175, 1972, 'Kisah keluarga mafia Corleone dan transisi kekuasaan dari ayah ke putranya.', 'the-godfather.jpg'],
            ['Spirited Away', 'Fantasy', 125, 2001, 'Seorang gadis terjebak di dunia roh dan harus bekerja untuk menyelamatkan orang tuanya.', 'spirited-away.jpg'],
            ['Joker', 'Drama', 122, 2019, 'Perjalanan Arthur Fleck, komedian gagal yang perlahan berubah menjadi sosok kriminal.', 'joker.jpg'],
        ];

        foreach ($movies as [$title, $genre, $duration, $year, $desc, $poster]) {
            Movie::create([
                'title'         => $title,
                'genre'         => $genre,
                'duration'      => $duration,
                'release_years' => $year,
                'description'   => $desc,
                'poster'        => $poster,
            ]);
        }
    }
}