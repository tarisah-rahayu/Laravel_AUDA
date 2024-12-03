<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    protected $primaryKey = 'id_pesan';
    protected $fillable = [
        'jumlah_pesan',
        'status_pesan',
        'tanggal_pesan',
        'tanggal_terima',
        'id_supplier',
        'id_admin',
        'id_barang',
        
    ];
}
