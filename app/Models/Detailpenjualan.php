<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detailpenjualan extends Model
{
    use HasFactory;

    protected $table = 'detailpenjualans';
    protected $primaryKey = 'id_detail';
    public $incrementing = true;
    protected $fillable = ['id_detail', 'id_penjualan', 'id_produk', 'jumlah_produk', 'subtotal'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id_penjualan');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($detail) {
            $produk = Produk::find($detail->id_produk);
            $penjualan = Penjualan::find($detail->id_penjualan);

            if (!$produk || !$penjualan) {
                throw new \Exception('Produk atau Penjualan tidak ditemukan.');
            }

            if ($detail->isDirty('jumlah_produk')) {
                if ($detail->exists) {
                    $oldDetail = Detailpenjualan::find($detail->id_detail);
                    if ($oldDetail) {
                        $produk->stok += $oldDetail->jumlah_produk;
                    }
                }

                if ($produk->stok >= $detail->jumlah_produk) {
                    $produk->stok -= $detail->jumlah_produk;
                } else {
                    throw new \Exception('Stok produk tidak mencukupi.');
                }

                $produk->save();
            }

            if ($detail->isDirty('subtotal')) {
                if ($detail->exists) {
                    $oldDetail = Detailpenjualan::find($detail->id_detail);
                    if ($oldDetail) {
                        $penjualan->total_harga -= $oldDetail->subtotal;
                    }
                }

                $penjualan->total_harga += $detail->subtotal;
                $penjualan->save();
            }
        });

        static::deleting(function ($detail) {
            $produk = Produk::find($detail->id_produk);
            $penjualan = Penjualan::find($detail->id_penjualan);

            if ($produk) {
                $produk->stok += $detail->jumlah_produk;
                $produk->save();
            }

            if ($penjualan) {
                $penjualan->total_harga -= $detail->subtotal;
                $penjualan->save();
            }
        });
    }
}
