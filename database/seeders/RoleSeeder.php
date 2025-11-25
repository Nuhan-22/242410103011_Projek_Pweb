<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role')->insert([
            // ID 1
            ['id_role' => 1, 'nama_role' => 'Super Admin'],
            // ID 2
            ['id_role' => 2, 'nama_role' => 'Admin'],
            // ID 3 - Ini adalah ID yang dibutuhkan untuk 'Visitor/Pengguna Biasa' saat registrasi!
            ['id_role' => 3, 'nama_role' => 'Pemilik Tempat Wisata'],
            // ID 4
            ['id_role' => 4, 'nama_role' => 'Pengguna Biasa'],
        ]);
    }
}
