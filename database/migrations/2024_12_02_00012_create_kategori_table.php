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
        Schema::create('kategori', function (Blueprint $table) {

            // PERBAIKAN: Menggunakan id() untuk Primary Key yang auto-increment.
            // Ini menggantikan kode yang bermasalah (bigInteger()->primary()->autoIncrement()).
            $table->id('id_kategori');

            $table->string('nama_kategori', 50)->unique();

            // Tambahan standar Laravel
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
