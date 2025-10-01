<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
    ];

    public function kesehatanLingkungans()
    {
        return $this->hasMany(KesehatanLingkungan::class);
    }

    public function penyakits()
    {
        return $this->hasMany(Penyakit::class);
    }

    public function kesehatanGizis()
    {
        return $this->hasMany(KesehatanGizi::class);
    }

    public function kesehatanAnakIbus()
    {
        return $this->hasMany(KesehatanAnakIbu::class);
    }
}
