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
        Schema::create('tipe_tiket', function (Blueprint $table) {

            // FIX: Using id() for the auto-increment Primary Key.
            $table->id('id_tipe_tiket');

            $table->string('nama_tipe', 50);

            // Foreign Key to tempat_wisata
            $table->foreignId('id_tempat_wisata')
                  ->constrained('tempat_wisata', 'id_tempat_wisata') // Explicitly reference the column name
                  ->onDelete('cascade');

            $table->time('waktu_dimulai');
            $table->time('waktu_berakhir');
            $table->double('harga');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_tiket');
    }
};
