<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_produk',
        'nama_produk',
        'harga',
        'stok',
    ];

protected $primaryKey = 'id_produk';
public $incrementing = false;
protected $keyType = 'string';
protected $dates = ['created_at', 'updated_at'];
}