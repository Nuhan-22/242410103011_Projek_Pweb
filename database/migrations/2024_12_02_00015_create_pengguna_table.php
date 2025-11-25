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
        Schema::create('pengguna', function (Blueprint $table) {

            // PERBAIKAN: Menggunakan id() untuk Primary Key yang auto-increment.
            // Ini akan membuat kolom 'id_pengguna' dengan benar.
            $table->id('id_pengguna');

            $table->string('nama_depan');
            $table->string('nama_belakang')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('username')->unique();
            $table->string('password');

            $table->string('foto_profil')->nullable();

            $table->rememberToken();
            $table->timestamps(); // Termasuk created_at dan updated_at

            // Foreign Key
            $table->foreignId('id_role')
                  ->constrained('role') // Asumsi tabel tujuan adalah 'role'
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
