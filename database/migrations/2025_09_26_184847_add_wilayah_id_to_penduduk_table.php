<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWilayahIdToPendudukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            // Tambahkan kolom wilayah_id sebagai foreign key
            // Dibuat nullable jika data penduduk lama diizinkan tanpa wilayah,
            // namun sebaiknya tidak nullable untuk data baru.
            $table->foreignId('wilayah_id')
                  ->nullable() 
                  ->after('alamat_lengkap') // Tambahkan setelah kolom 'alamat_lengkap'
                  ->constrained('wilayah')
                  ->onDelete('set null'); // Jika data wilayah dihapus, kolom ini jadi NULL
        });
    }

    public function down()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            // Hapus foreign key dan kolomnya saat rollback
            $table->dropConstrainedForeignId('wilayah_id');
            $table->dropColumn('wilayah_id');
        });
    }
}
