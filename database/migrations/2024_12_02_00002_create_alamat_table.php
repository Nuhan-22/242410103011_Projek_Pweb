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
        Schema::create('alamat', function (Blueprint $table) {
            // SOLUSI UTAMA: Menggunakan id() untuk Primary Key yang auto-increment.
            // Ini menggantikan bigInteger()->primary()->autoIncrement() yang bermasalah di SQLite.
            $table->id('id_alamat');

            // Kolom Data Alamat
            $table->string('jalan', 90)->nullable();
            $table->string('dusun', 40)->nullable();
            $table->string('desa', 40)->nullable();
            $table->string('kecamatan', 40);
            $table->string('kota', 50);
            $table->string('kabupaten', 50);
            $table->string('provinsi', 50);

            // FOREIGN KEY: Menggunakan foreignId() untuk tipe BIGINT unsigned yang benar
            // dan menghubungkannya sebagai foreign key ke tabel 'tempat_wisata'.
            // Saya menghilangkan unique('alamat_idx') karena biasanya satu tempat wisata
            // hanya memiliki satu baris alamat di tabel ini, namun kita akan biarkan
            // Laravel yang menangani Foreign Key constraint.
            $table->foreignId('id_tempat_wisata')
                  ->constrained('tempat_wisata') // Asumsi tabel tujuan adalah 'tempat_wisata'
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
        Schema::dropIfExists('alamat');
    }
};
