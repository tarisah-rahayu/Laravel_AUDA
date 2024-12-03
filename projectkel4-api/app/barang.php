<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang',
        'total',
        'harga_barang',
        'jml_stok',
        'gambar',
        'deskripsi',
    ];
}
