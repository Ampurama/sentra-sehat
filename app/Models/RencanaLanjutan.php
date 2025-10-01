<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaLanjutan extends Model
{
    use HasFactory;

    protected $table = 'rencana_lanjutan';

    protected $fillable = [
        'tindakan_intervensi_id',
        'keluhan_komplikasi',
        'jadwal_kontrol_berikutnya',
        'terapi_lanjutan',
        'kebutuhan_pendampingan',
        'keterangan_lain',
    ];

    // Hubungan Inverse ke Tindakan Intervensi
    public function tindakanIntervensi()
    {
        return $this->belongsTo(TindakanIntervensi::class);
    }
}