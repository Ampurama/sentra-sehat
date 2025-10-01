<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesehatanAnakIbu extends Model
{
    use HasFactory;

    protected $fillable = [
        'sektor_id',
        'penduduk_id',
        'child_vaccinations_complete',
        'maternal_checkups_count',
        'birth_weight',
        'last_checkup',
        'notes',
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
