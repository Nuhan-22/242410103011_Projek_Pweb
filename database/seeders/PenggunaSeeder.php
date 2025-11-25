<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'nama_depan' => 'Ahmad',
                'nama_belakang' => 'Fauzan',
                'email' => 'noxindocraft@gmail.com',
                'username' => 'neiaozora',
                'password' => Hash::make('fauzan123'),
                'foto_profil' => '',
                'id_role' => 1 // Super Admin
            ],
            [
                'nama_depan' => 'Alyasyi',
                'nama_belakang' => 'Thobiq',
                'email' => 'thobiw@gmail.com',
                'username' => 'thobiw',
                'password' => Hash::make('thobiw123'),
                'foto_profil' => '',
                'id_role' => 2 // Admin
            ],
            [
                'nama_depan' => 'Bobon',
                'nama_belakang' => 'Santoso',
                'email' => 'bobon@gmail.com',
                'username' => 'bobon',
                'password' => Hash::make('bobon123'),
                'foto_profil' => '',
                'id_role' => 3 // Pemilik tempat wisata
            ],
            [
                'nama_depan' => 'Garox',
                'nama_belakang' => 'Santoso',
                'email' => 'garox@gmail.com',
                'username' => 'garox',
                'password' => Hash::make('garox123'),
                'foto_profil' => '',
                'id_role' => 4 // Pengunjung Biasa
            ],
            [
                'nama_depan' => 'Achmad',
                'nama_belakang' => 'Nuhan',
                'email' => 'achmadnuhan@gmail.com',
                'username' => 'achmadnuhan',
                'password' => Hash::make('achmadnuhan123'),
                'foto_profil' => '',
                'id_role' => 1 // Super Admin
            ],
            [
                'nama_depan' => 'Achmad',
                'nama_belakang' => 'Nuhan',
                'email' => 'achmadnuhan.admin@gmail.com',
                'username' => 'achmadnuhan_admin',
                'password' => Hash::make('nuhan123'),
                'foto_profil' => '',
                'id_role' => 2 // Admin
            ],
            [
                'nama_depan' => 'Achmad',
                'nama_belakang' => 'Nuhan',
                'email' => 'achmadnuhan.visitor@gmail.com',
                'username' => 'achmadnuhan_visitor',
                'password' => Hash::make('visitor123'),
                'foto_profil' => '',
                'id_role' => 4 // Pengunjung Biasa
            ],


        ]);
    }
}
