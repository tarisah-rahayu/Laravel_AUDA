<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    protected $primaryKey = 'id_pesan';
    protected $fillable = [
        'satuan_pesanan',
        'status_pesanan',
        'tanggal_pesan',
        'tanggal_terima',
        'id_supplier',
        'id_karyawan',
        'id_barang',
        
    ];
}

