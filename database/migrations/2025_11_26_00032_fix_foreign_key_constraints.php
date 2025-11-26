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
        // Fix foreign key constraints untuk menghindari duplicate constraints

        // Drop existing constraints jika ada
        Schema::table('gambar_ulasan', function (Blueprint $table) {
            // Cek dan drop jika constraint sudah ada
            if (Schema::hasColumn('gambar_ulasan', 'id_ulasan')) {
                try {
                    $table->dropForeign(['id_ulasan']);
                } catch (\Exception $e) {
                    // Constraint mungkin tidak ada
                }
            }
        });

        // Re-create gambar_ulasan foreign key dengan benar
        Schema::table('gambar_ulasan', function (Blueprint $table) {
            // Pastikan menggunakan benar primary key yang di-referensikan
            $table->foreign('id_ulasan', 'gambar_ulasan_id_ulasan_fk')
                  ->references('id_ulasan')
                  ->on('ulasan')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gambar_ulasan', function (Blueprint $table) {
            try {
                $table->dropForeign('gambar_ulasan_id_ulasan_fk');
            } catch (\Exception $e) {
                // Already dropped
            }
        });
    }
};
