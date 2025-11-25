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
        Schema::create('tempat_wisata', function (Blueprint $table) {

            // PERBAIKAN: Menggunakan id() untuk Primary Key yang auto-increment.
            $table->id('id_tempat_wisata');

            $table->string('nama', 100);
            $table->text('deskripsi')->nullable();
            $table->string('link_gmaps')->nullable();

            // Foreign Key
            $table->foreignId('id_pengguna')
                  ->nullable() // Asumsi id_pengguna bisa null jika tempat wisata dibuat oleh admin/sistem
                  ->constrained('pengguna') // Target tabel 'pengguna'
                  ->onDelete('set null'); // Set null jika pengguna dihapus

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat_wisata');
    }
};
