<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('carousels')->insert([         [
            'id_carousel' => 1,
            'judul' => 'Menyaksikan Keajaiban Sunrise di Gunung Bromo',
            'deskripsi' => 'Nikmati keindahan alam yang memukau saat matahari terbit di salah satu gunung terindah di Indonesia.',
            'url_gambar' => 'assets/images/homepage/gunung-bromo.svg',
            'link_button' => '/tempat-wisata/2'
            ],
            [
            'id_carousel' => 2,
            'judul' => 'Menikmati Keindahan Alam Pantai Kuta di Bali',
            'deskripsi' => 'Jelajahi keindahan alam Bali dengan pemandangan pantai yang memukau.',
            'url_gambar' => 'storage/pantai-kuta.jpg',
            'link_button' => '/tempat-wisata/1'
            ],
        ]
    );
    }
}
