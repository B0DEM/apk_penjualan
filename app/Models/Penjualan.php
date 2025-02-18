<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $primaryKey = 'id_penjualan';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['id_penjualan', 'tanggal_penjualan', 'id_pelanggan', 'total_harga'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function detailpenjualans()
    {
        return $this->hasMany(Detailpenjualan::class, 'id_penjualan', 'id_penjualan');
    }
}
