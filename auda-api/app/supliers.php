<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supliers extends Model
{
    protected $primaryKey = 'id_supplier';
    protected $fillable = [
        'nama_supplier',
        'jenis_supplier',
        'alamat_supplier',
        'no_hp_supplier',
    ];
}
