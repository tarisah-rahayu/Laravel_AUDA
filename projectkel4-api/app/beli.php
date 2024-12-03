<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    protected $primaryKey = 'id_beli';
    protected $fillable = [
        'alamat_penerima',
        'tanggal_beli',
        'tanggal_kirim',
        'qty',
        'status',
        'id_konsumen',
        'id_barang', 
    ];
}
