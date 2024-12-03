<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class konsumen extends Model
{
    protected $primaryKey = 'id_konsumen';
    protected $fillable = [
        'nama_konsumen',
        'alamat_konsumen',
        'no_hp_konsumen',
        
    ];
    
}

