<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterATK extends Model
{
    protected $table = 'tb_master_atk';
    protected $fillable = ['nama_barang', 'satuan', 'harga', 'stok_awal', 'stok_sekarang', 'keterangan'];
}
