<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiModel extends Model
{


    protected $table = 't_lokasi';
    protected $primaryKey = 'id_lokasi';

    protected $fillable = [
        'kode_lokasi',
        'alamat_lokasi',
        'kelurahan_lokasi',
        'kecamatn_lokasi',
        'kota_kab_lokasi',
        'provinsi_lokasi'
    ];
}
