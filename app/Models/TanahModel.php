<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TanahModel extends Model
{
    use HasFactory;
    protected $table = 't_tanah';
    protected $primaryKey = 'id_tanah';
    public $fillable = ['kode_tanah', 'id_lokasi', 'no_kav_tanah','panjang_tanah','lebar_tanah','harga'];

    public function lokasi(): BelongsTo {
        return $this->belongsTo(LokasiModel::class, 'id_lokasi','id_lokasi');
    }
}
