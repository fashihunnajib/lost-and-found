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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['lost', 'found']); // Status barang: 'lost' (hilang), 'found' (ditemukan)
            $table->string('title'); // Nama barang, misal: "Kunci Motor Honda"
            $table->text('description'); // Ciri-ciri spesifik
            $table->string('location'); // Lokasi terakhir terlihat / ditemukan
            $table->string('contact'); // Kontak yang bisa dihubungi
            $table->enum('status', ['open', 'resolved'])->default('open'); // 'open' = belum kembali, 'resolved' = sudah kembali
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
