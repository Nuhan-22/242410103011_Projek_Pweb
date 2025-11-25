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
        Schema::create('fasilitas', function (Blueprint $table) {

            // PERBAIKAN: Mengganti bigInteger()->primary()->autoIncrement()
            // dengan metode id() standar Laravel untuk Primary Key.
            $table->id('id_fasilitas');

            $table->string('nama_fasilitas', 60);

            // Kolom Foreign Key (lebih baik menggunakan foreignId() untuk tipe data yang tepat)
            $table->foreignId('id_tempat_wisata')
                  // Anda bisa menambahkan ->constrained('nama_tabel') untuk Foreign Key constraint
                  // Jika Anda hanya ingin index seperti kode Anda:
                  ->index('fasilitas_tempat_wisata_fk');

            $table->timestamps(); // Tambahkan timestamps standar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
