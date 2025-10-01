<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;

    protected $table = 'wilayah';

    protected $fillable = [
        'nama_desa',
        'nama_kecamatan',
        'nama_kabupaten',
        'latitude',
        'longitude',
    ];
    
    // Asumsi tabel 'penduduk' memiliki foreign key 'wilayah_id'
    public function penduduk()
    {
        return $this->hasMany(Penduduk::class, 'wilayah_id');
    }

    public function kesehatanLingkungans()
    {
        return $this->hasMany(KesehatanLingkungan::class);
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