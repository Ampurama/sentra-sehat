<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wilayah;
use App\Models\FaktorRisiko;
use App\Models\TindakanIntervensi;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';

    protected $fillable = [
        'NIK',
        'nama',
        'JK',
        'tempat_lahir',
        'TTL',
        'alamat_lengkap',
        'wilayah_id',
        'no_telp',
        'no_bpjs',
        'kepala_keluarga_id', // Kolom Foreign Key untuk Kepala Keluarga

        // **TAMBAHAN:** Faktor Risiko (Berdasarkan Controller sebelumnya)
        // Jika Anda ingin menyimpan ini di tabel Penduduk
        'riwayat_merokok',
        'riwayat_alkohol',
        'riwayat_penyakit_keturunan',

        // **TAMBAHAN:** Data Klinis Pasien
        'data_klinis_ringkas',
        'diagnosis_utama',
        'diagnosis_penyerta',
        'tindakan_perawatan',
        'obat_pulang',
        'alat_kesehatan_rumah',
        'status_fungsional_pulang',
        'hasil_pemeriksaan_terakhir',
    ];

    // -------------------------------------------------------------------
    // RELASI TAMBAHAN PENTING
    // -------------------------------------------------------------------
    
    // 1. RELASI SELF-REFERENCING (Sebagai Anggota Keluarga)
    // Menghubungkan anggota keluarga ini ke data Kepala Keluarga (di tabel yang sama).
    public function kepalaKeluarga()
    {
        // Foreign Key: kepala_keluarga_id merujuk pada id dari Penduduk (dirinya sendiri)
        return $this->belongsTo(Penduduk::class, 'kepala_keluarga_id');
    }

    // 2. RELASI SELF-REFERENCING (Sebagai Kepala Keluarga)
    // Menghubungkan Kepala Keluarga ini ke daftar anggota keluarganya.
    public function anggotaKeluarga()
    {
        // Foreign Key: Mencari record lain yang memiliki kepala_keluarga_id sama dengan id-nya.
        return $this->hasMany(Penduduk::class, 'kepala_keluarga_id');
    }
    
    // -------------------------------------------------------------------
    // RELASI LAMA ANDA
    // -------------------------------------------------------------------

    // Relasi One-to-One ke Faktor Risiko
    public function faktorRisiko()
    {
        return $this->hasOne(FaktorRisiko::class);
    }

    // Relasi One-to-Many ke Tindakan Intervensi (sebagai pasien)
    public function tindakanIntervensi()
    {
        return $this->hasMany(TindakanIntervensi::class, 'pasien_id');
    }
    
    // Relasi Many-to-One ke Wilayah (Foreign Key: wilayah_id)
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }
    public function riwayatIntervensi()
    {
        // Hubungan One-to-Many ke TindakanIntervensi (menggunakan 'pasien_id')
        return $this->hasMany(TindakanIntervensi::class, 'pasien_id');
    }

    public function kesehatanGizis()
    {
        return $this->hasMany(KesehatanGizi::class);
    }

    public function kesehatanAnakIbus()
    {
        return $this->hasMany(KesehatanAnakIbu::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}