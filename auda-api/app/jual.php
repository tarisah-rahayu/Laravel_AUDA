<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    protected $primaryKey = 'id_jual';
    protected $fillable = [
        'alamat_penerima',
        'tgl_jual',
        'tgl_kirim',
        'qty',
        'satuan',
        'status',
        'id_barang',
        'id_konsumen',
        
    ];
}
