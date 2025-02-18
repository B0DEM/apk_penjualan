<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detailpenjualans', function (Blueprint $table) {
            $table->string('id_detail')->primary();
            $table->string('id_penjualan');
            $table->string('id_produk');
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualans')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onDelete('cascade');
            $table->string('jumlah_produk');
            $table->string('subtotal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detailpenjualans');
    }
};
