<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'id_pelanggan',
        'nama_pelanggan',
        'alamat',
        'no_telpon',
    ];

protected $primaryKey = 'id_pelanggan';
public $incrementing = false;
protected $keyType = 'string';
protected $dates = ['created_at', 'updated_at'];
}