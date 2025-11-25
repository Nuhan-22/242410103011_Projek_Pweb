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
        Schema::create('hari', function (Blueprint $table) {

            // PERBAIKAN: Menggunakan id() untuk Primary Key yang auto-increment.
            // Ini menggantikan bigInteger()->primary()->autoIncrement() yang bermasalah.
            $table->id('id_hari');

            $table->string('nama_hari', 17);

            // Foreign Key untuk menghubungkan ke tabel 'tipe_tiket'.
            $table->foreignId('id_tipe_tiket')
                  ->constrained('tipe_tiket') // Asumsi tabel tujuan adalah 'tipe_tiket'
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
        Schema::dropIfExists('hari');
    }
}; 
