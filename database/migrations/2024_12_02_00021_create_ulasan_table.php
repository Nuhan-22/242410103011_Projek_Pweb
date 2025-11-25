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
        Schema::create('ulasan', function (Blueprint $table) {

            // PERBAIKAN: Menggunakan id() untuk Primary Key yang auto-increment.
            $table->id('id_ulasan');

            $table->integer('nilai_rating')->nullable();
            $table->text('isi_komentar');

            // Foreign Key ke tempat_wisata
            $table->foreignId('id_tempat_wisata')
                  ->constrained('tempat_wisata', 'id_tempat_wisata')
                  ->onDelete('cascade');

            // Foreign Key ke pengguna
            $table->foreignId('id_pengguna')
                  ->constrained('pengguna', 'id_pengguna')
                  ->onDelete('cascade');

            // Foreign Key untuk membalas ulasan (Self-referencing Foreign Key)
            $table->foreignId('id_ulasan_yg_dibalas')
                  ->nullable() // Karena tidak semua ulasan adalah balasan
                  ->constrained('ulasan', 'id_ulasan')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
