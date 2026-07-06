<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_transaksi_atk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barang')->constrained('tb_master_atk')->onDelete('cascade');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('id_transaksi')->unique();
            $table->enum('tipe', ['masuk', 'keluar']);
            $table->integer('qty');
            $table->integer('harga_satuan');
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
        Schema::dropIfExists('atk_transaksis');
    }
};
