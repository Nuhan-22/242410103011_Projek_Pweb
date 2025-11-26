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
        Schema::create('gambar_tempat_wisata', function (Blueprint $table) {

            // PERBAIKAN: Mengganti bigInteger()->primary()->autoIncrement()
            // dengan metode id() standar Laravel untuk Primary Key yang aman dari duplikasi.
            $table->id('id_gambar_tempat_wisata');

            $table->string('url_gambar');

            // Gunakan foreignId() untuk tipe data Foreign Key yang tepat (BIGINT unsigned)
            // dan tambahkan constraint agar merujuk ke tabel 'tempat_wisata'.
            $table->foreignId('id_tempat_wisata')
                  ->constrained('tempat_wisata')
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
        Schema::dropIfExists('gambar_tempat_wisata');
    }
};
