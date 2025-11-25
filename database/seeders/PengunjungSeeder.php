<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengunjungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $data = [];
        $recordsCount = rand(4000, 8000); // Random count of records between 4000 and 8000

        for ($i = 0; $i < $recordsCount; $i++) {
            $data[] = [
                'waktu_kunjungan' => $faker->dateTimeBetween('-3 years', 'now'), // Random dates from 2021 to now
                'alamat_ip' => $faker->ipv4(),
                'user_agent' => $faker->userAgent(),
            ];
        }

        // Insert data in chunks to avoid memory issues
        foreach (array_chunk($data, 1000) as $chunk) {
            DB::table('pengunjung')->insert($chunk);
        }
    }
}
