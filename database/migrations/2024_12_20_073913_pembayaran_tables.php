<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Create Pesanan_Tiket table
        Schema::create('pesanan_tiket', function (Blueprint $table) {

            // PERBAIKAN PRIMARY KEY
            $table->id('id_pesanan');

            // PERBAIKAN FOREIGN KEY: Menggunakan foreignId()
            $table->foreignId('id_pengguna')
                  ->constrained('pengguna', 'id_pengguna') // Asumsi tabel pengguna memiliki ID pengguna
                  ->onDelete('cascade');

            $table->string('status', 20); // Status of the order (e.g., pending, paid, cancelled)
            $table->timestamps();
        });

        // 2. Create Tiket table (Detail Pesanan)
        Schema::create('tiket', function (Blueprint $table) {

            // PERBAIKAN PRIMARY KEY
            $table->id('id_tiket');

            // PERBAIKAN FOREIGN KEY: Menggunakan foreignId()
            $table->foreignId('id_tipe_tiket')
                  ->constrained('tipe_tiket', 'id_tipe_tiket')
                  ->onDelete('restrict');

            // PERBAIKAN FOREIGN KEY: Menggunakan foreignId()
            $table->foreignId('id_pesanan_tiket')
                  ->constrained('pesanan_tiket', 'id_pesanan')
                  ->onDelete('cascade');

            $table->integer('jumlah_tiket');
            $table->decimal('harga_per_unit', 10, 2);
            $table->timestamp('berlaku_sampai')->nullable();
            $table->timestamp('tanggal_kunjungan');
            $table->string('status', 10); // Status of the ticket (e.g., active, used, expired)
            $table->timestamps();
        });

        // 3. Create Pembayaran table
        Schema::create('pembayaran', function (Blueprint $table) {

            // PERBAIKAN PRIMARY KEY
            $table->id('id_pembayaran');

            // Menghubungkan Pembayaran ke Pesanan (Hubungan 1:1, setiap pesanan memiliki 1 pembayaran)
            $table->foreignId('id_pesanan_tiket')
                  ->unique() // Memastikan hanya ada satu pembayaran per pesanan
                  ->constrained('pesanan_tiket', 'id_pesanan')
                  ->onDelete('cascade');

            $table->string('bukti_pembayaran', 255)->nullable(); // Path/URL
            $table->string('metode_pembayaran', 50)->nullable();
            $table->string('status_pembayaran', 20); // Status payment (e.g., completed, rejected, waiting)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop tabel dengan urutan yang benar (yang bergantung dijatuhkan duluan)
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('tiket');
        Schema::dropIfExists('pesanan_tiket');
    }
};
