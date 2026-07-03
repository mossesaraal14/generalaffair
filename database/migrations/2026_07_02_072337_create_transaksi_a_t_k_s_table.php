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
        Schema::create('tb_transaksi_atk', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke Master ATK
            $table->foreignId('id_barang')->constrained('tb_master_atk')->onDelete('cascade');

            $table->string('no_transaksi')->unique();
            $table->string('jenis_transaksi');
            $table->integer('qty');
            $table->integer('harga_satuan'); // Dari Tabel Master
            $table->integer('total_harga');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_a_t_k_s');
    }
};
