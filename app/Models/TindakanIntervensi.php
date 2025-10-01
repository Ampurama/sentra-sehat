<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanIntervensi extends Model
{
    use HasFactory;

    protected $table = 'tindakan_intervensi';

    protected $fillable = [
        'pasien_id',
        'petugas_id',
        'penyakit_id',
        'tgl_tindakan',
        'diagnosis_utama',
        'tindakan_selama_perawatan',
        'status_fungsional',
    ];

    // Hubungan dengan Pasien (Penduduk)
    public function pasien()
    {
        return $this->belongsTo(Penduduk::class, 'pasien_id');
    }
    
    // Hubungan dengan Petugas (User)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // Hubungan One-to-One ke Rencana Lanjutan
    public function rencanaLanjutan()
    {
        return $this->hasOne(RencanaLanjutan::class);
    }

    // Hubungan dengan Penyakit
    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class);
    }
}
