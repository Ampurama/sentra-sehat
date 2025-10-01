<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi (role vs roles)
    // Dalam kasus Anda, migration membuat tabel 'roles', jadi ini opsional:
    protected $table = 'roles'; 

    // Kolom-kolom yang aman untuk diisi (berdasarkan migration Anda)
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi: Satu Role dimiliki oleh banyak User (One-to-Many).
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}