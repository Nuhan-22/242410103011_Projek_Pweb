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

            // Foreign Key columns tanpa constraint (akan ditambah di migration terpisah)
            // Ini menghindari duplicate constraint
            $table->unsignedBigInteger('id_tempat_wisata');
            $table->unsignedBigInteger('id_pengguna');
            $table->unsignedBigInteger('id_ulasan_yg_dibalas')->nullable();

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
