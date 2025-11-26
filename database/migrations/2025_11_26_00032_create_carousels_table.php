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
        Schema::create('carousels', function (Blueprint $table) {
            $table->id('id_carousel')->autoIncrement();; // Primary key
            $table->string('judul'); // Title of the carousel
            $table->text('deskripsi')->nullable(); // Description, nullable
            $table->string('url_gambar'); // Image URL
            $table->string('link_button')->nullable(); // Button link, nullable
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousels');
    }
};
