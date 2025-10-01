<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTempatLahirToPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            
            // 1. TAMBAHKAN KOLOM BARU: tempat_lahir
            // Kolom ini menampung string (nama kota/tempat)
            $table->string('tempat_lahir', 100)->nullable()->after('TTL'); 
            
            // Kolom TTL (lama) dibiarkan tetap string, tetapi sekarang hanya diisi tanggal (YYYY-MM-DD)
            // KITA MENGHAPUS: $table->date('TTL')->change();
            
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('penduduk', function (Blueprint $table) {
            // HAPUS KOLOM BARU: tempat_lahir
            $table->dropColumn('tempat_lahir');
            
            // KITA TIDAK MELAKUKAN PERUBAHAN TIPE DATA LAGI
        });
    }
}
