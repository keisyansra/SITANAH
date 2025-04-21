<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenjualanModel extends Model
{
    use HasFactory;

    protected $table = 't_penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $fillable = ['kode_penjualan', 'id_nasabah', 'id_tanah', 'pembayaran'];

    public function nasabah(): BelongsTo {
        return $this->belongsTo(NasabahModel::class, 'id_nasabah','id_nasabah');
    }
    public function tanah(): BelongsTo {
        return $this->belongsTo(TanahModel::class, 'id_tanah', 'id_tanah');
    }
}
