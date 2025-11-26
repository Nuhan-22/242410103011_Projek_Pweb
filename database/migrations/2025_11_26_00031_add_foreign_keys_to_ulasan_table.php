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
        Schema::table('ulasan', function (Blueprint $table) {
            $table->foreign(['id_pengguna'], 'ulasan_pengguna_fk')->references(['id_pengguna'])->on('pengguna')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_tempat_wisata'], 'ulasan_tempat_wisata_fk')->references(['id_tempat_wisata'])->on('tempat_wisata')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['id_ulasan_yg_dibalas'], 'ulasan_ulasan_fk')->references(['id_ulasan'])->on('ulasan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ulasan', function (Blueprint $table) {
            $table->dropForeign('ulasan_pengguna_fk');
            $table->dropForeign('ulasan_tempat_wisata_fk');
            $table->dropForeign('ulasan_ulasan_fk');
        });
    }
};
