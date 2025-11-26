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
        Schema::create('gambar_ulasan', function (Blueprint $table) {

            // PERBAIKAN: Menggunakan id() untuk Primary Key yang auto-increment.
            // Ini akan membuat kolom 'id_gambar_ulasan' dengan benar.
            $table->id('id_gambar_ulasan');

            $table->string('url_gambar');

            // Foreign Key untuk menghubungkan ke tabel 'ulasan'.
            // Menggunakan foreignId() untuk tipe data BIGINT unsigned yang tepat.
            // Spesifikan column 'id_ulasan' karena itu adalah primary key di tabel ulasan
            $table->foreignId('id_ulasan')
                  ->constrained('ulasan', 'id_ulasan') // Spesifik ke kolom id_ulasan
                  ->onDelete('cascade');

            // Tambahan standar Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_ulasan');
    }
};
