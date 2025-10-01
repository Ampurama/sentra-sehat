<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaktorRisiko extends Model
{
    use HasFactory;

    protected $table = 'faktor_risiko';

    protected $fillable = [
        'penduduk_id',
        'riwayat_merokok',
        'riwayat_alkohol',
        'riwayat_penyakit_keturunan',
        'data_edukasi_telah_diberikan',
    ];

    // Relasi Inverse ke Penduduk
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}