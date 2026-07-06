<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtkTransaksi extends Model
{
    protected $table = 'tb_transaksi_atk';

    protected $fillable = ['id_barang', 'id_user', 'id_transaksi', 'tipe', 'qty', 'harga_satuan', 'total_harga', 'keterangan'];

    // Relasi
    public function masterAtk() {
        return $this->belongsTo(MasterATK::class, 'id_barang');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
