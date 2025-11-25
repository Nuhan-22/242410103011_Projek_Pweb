<?php

namespace Database\Seeders;

use App\Helpers\JsonImporter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempatWisataAndTheBoysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $importer = new \App\Helpers\JsonImporter();
        $importer->import(base_path() . "/database/db_values.json");

    }
}
