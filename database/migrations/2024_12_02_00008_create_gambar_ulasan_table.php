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
            // Tambahkan ->constrained() untuk Foreign Key yang sebenarnya.
            $table->foreignId('id_ulasan')
                  ->constrained('ulasan') // Asumsi tabel tujuan adalah 'ulasan'
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
