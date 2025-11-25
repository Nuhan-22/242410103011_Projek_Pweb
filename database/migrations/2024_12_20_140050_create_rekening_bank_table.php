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
        Schema::create('rekening_bank', function (Blueprint $table) {

            // PERBAIKAN: Menggunakan id() untuk Primary Key yang auto-increment.
            $table->id('id_rekening_bank');

            $table->string('nama_bank', 50);
            $table->string('nomer_rekening', 30)->unique();

            // Foreign Key ke tempat_wisata (dibuat nullable, asumsi satu tempat wisata bisa punya banyak rekening bank, atau tidak punya sama sekali)
            $table->foreignId('id_tempat_wisata')
                  ->nullable()
                  ->constrained('tempat_wisata', 'id_tempat_wisata')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekening_bank');
    }
};
