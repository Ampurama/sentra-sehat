<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesehatanLingkungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'sektor_id',
        'wilayah_id',
        'description',
        'air_quality',
        'sanitation_level',
        'waste_management',
    ];

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }
}
