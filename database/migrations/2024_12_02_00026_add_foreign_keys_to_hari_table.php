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
        Schema::table('hari', function (Blueprint $table) {
            $table->foreign(['id_tipe_tiket'], 'hari_tipe_tiket_fk')->references(['id_tipe_tiket'])->on('tipe_tiket')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hari', function (Blueprint $table) {
            $table->dropForeign('hari_tipe_tiket_fk');
        });
    }
};
