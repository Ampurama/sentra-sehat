<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesehatanGizi extends Model
{
    use HasFactory;

    protected $fillable = [
        'sektor_id',
        'penduduk_id',
        'bmi',
        'diet_type',
        'deficiencies',
        'nutritional_status',
        'assessment_date',
    ];

    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
