<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NasabahModel extends Model
{
    use HasFactory;

    protected $table = 't_nasabah'; // definisi nama tabel yang digunakan 
    protected $primaryKey = 'id_nasabah'; // definisi primary key dari tabel yang digunakan 

    protected $fillable = [
        'kode_nasabah', 'nama_nasabah', 'alamat_nasabah',
        'telp_nasabah', 'nama_kerabat_nasabah', 'telp_kerabat_nasabah'
    ];
}
