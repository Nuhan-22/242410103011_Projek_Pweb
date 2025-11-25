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
        // 1. Create the platform_sosial_media table
        Schema::create('platform_sosial_media', function (Blueprint $table) {
            // PERBAIKAN PRIMARY KEY
            $table->id('id_platform');

            $table->string('nama_platform', 25)->unique();
            $table->timestamps();
        });

        // 2. Create the sosial_media table
        Schema::create('sosial_media', function (Blueprint $table) {
            // PERBAIKAN PRIMARY KEY
            $table->id('id_sosial_media');

            $table->string('link_sosial_media');

            // PERBAIKAN FOREIGN KEY: Menggunakan foreignId()
            // Foreign key to tempat_wisata table
            $table->foreignId('id_tempat_wisata')
                  ->constrained('tempat_wisata', 'id_tempat_wisata') // Target kolom eksplisit
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            // PERBAIKAN FOREIGN KEY: Menggunakan foreignId()
            // Foreign key to platform_sosial_media table
            $table->foreignId('id_platform')
                  ->constrained('platform_sosial_media', 'id_platform') // Target kolom eksplisit
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tabel sosial_media yang memiliki foreign key
        Schema::dropIfExists('sosial_media');

        // Drop tabel platform_sosial_media
        Schema::dropIfExists('platform_sosial_media');
    }
};
