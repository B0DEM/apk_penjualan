<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->string('id_produk')->primary();
            $table->string('nama_produk');
            $table->decimal('harga', 10, 2);
            $table->string('stok');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');}
};