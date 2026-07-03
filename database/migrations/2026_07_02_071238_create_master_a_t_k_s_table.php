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
        Schema::create('tb_master_atk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang')->unique();
            $table->string('satuan');
            $table->integer('harga');
            $table->integer('stok_awal')->default(0);
            $table->integer('stok_sekarang')->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_a_t_k_s');
    }
};
