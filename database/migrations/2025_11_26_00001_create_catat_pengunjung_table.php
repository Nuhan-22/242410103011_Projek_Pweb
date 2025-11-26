<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengunjung', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_kunjungan')->useCurrent();
            $table->string('alamat_ip', 45)->nullable();
            $table->text('user_agent')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengunjung');
    }
};
