<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyakit extends Model
{
    use HasFactory;

    protected $fillable = [
        'sektor_id',
        'name',
        'description',
        'symptoms',
        'prevalence',
        'icd_code',
        'spesialisasi',
    ];

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }

    public function tindakanIntervensis()
    {
        return $this->hasMany(TindakanIntervensi::class);
    }
}
