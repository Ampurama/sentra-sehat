<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nik',
        'password',
        'role_id',
        'sektor_id',
        'penduduk_id',
        'wilayah_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Relasi dengan Role (Peran Pengguna)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
    // Relasi dengan Sektor/Instansi
    public function sektor()
    {
        return $this->belongsTo(Sektor::class);
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }

    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }
}
