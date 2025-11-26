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
        Schema::table('tempat_wisata', function (Blueprint $table) {
            $table->foreign('id_pengguna', 'tempat_wisata_pengguna_fk')
                  ->references('id_pengguna')
                  ->on('pengguna')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tempat_wisata', function (Blueprint $table) {
            $table->dropForeign('tempat_wisata_pengguna_fk');
        });
    }
};
