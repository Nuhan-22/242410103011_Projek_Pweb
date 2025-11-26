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
        Schema::table('gambar_ulasan', function (Blueprint $table) {
            $table->foreign(['id_ulasan'], 'gambar_ulasan_ulasan_fk')->references(['id_ulasan'])->on('ulasan')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gambar_ulasan', function (Blueprint $table) {
            $table->dropForeign('gambar_ulasan_ulasan_fk');
        });
    }
};
