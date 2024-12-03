<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $primaryKey = 'id_admin';
    protected $fillable = [
        'nama_admin',
        'alamat_admin',
        'no_hp_admin',
    ];
}
