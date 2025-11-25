<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_wisata', function (Blueprint $table) {

            // Kolom Foreign Key (harus sesuai dengan tipe ID di tabel kategori)
            $table->foreignId('id_kategori')
                  ->constrained('kategori') // Asumsi target tabel kategori
                  ->onDelete('cascade');

            // Kolom Foreign Key (harus sesuai dengan tipe ID di tabel tempat_wisata)
            $table->foreignId('id_tempat_wisata')
                  ->constrained('tempat_wisata') // Asumsi target tabel tempat_wisata
                  ->onDelete('cascade');

            // SOLUSI: Definisikan primary key komposit HANYA di akhir.
            // TIDAK ADA kolom yang menggunakan ->id() atau ->primary()->autoIncrement()
            $table->primary(['id_kategori', 'id_tempat_wisata']);

            // Tambahan standar Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_wisata');
    }
};
