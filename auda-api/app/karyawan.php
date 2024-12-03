<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'nama_karyawan',
        'posisi',
        'alamat',
    ];
}
