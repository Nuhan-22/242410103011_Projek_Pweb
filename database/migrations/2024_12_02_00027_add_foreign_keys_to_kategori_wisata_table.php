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
        Schema::table('kategori_wisata', function (Blueprint $table) {
            $table->foreign(['id_kategori'], 'kategori_fk')->references(['id_kategori'])->on('kategori')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['id_tempat_wisata'], 'kategori_tempat_wisata_fk')->references(['id_tempat_wisata'])->on('tempat_wisata')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori_wisata', function (Blueprint $table) {
            $table->dropForeign('kategori_fk');
            $table->dropForeign('kategori_tempat_wisata_fk');
        });
    }
};
