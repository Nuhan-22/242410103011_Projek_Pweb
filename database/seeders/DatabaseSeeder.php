<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. NONAKTIFKAN FOREIGN KEY (khusus untuk SQLite)
        DB::statement('PRAGMA foreign_keys = OFF;');

        $this->call([
            // Role Seeder harus tetap yang pertama,
            // diikuti seeder yang bergantung padanya (PenggunaSeeder)
            RoleSeeder::class,
            PenggunaSeeder::class,

            // Seeder lainnya
            CarouselSeeder::class,
            // PengunjungSeeder::class,
            PlatformSeeder::class,
            TempatWisataAndTheBoysSeeder::class,
        ]);

        // 2. AKTIFKAN KEMBALI FOREIGN KEY
        DB::statement('PRAGMA foreign_keys = ON;');
    }
}
