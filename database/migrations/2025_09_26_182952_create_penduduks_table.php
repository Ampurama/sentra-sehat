<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('NIK', 16)->unique(); // Kunci utama untuk Identitas Pasien
            $table->string('nama');
            $table->string('JK'); // Jenis Kelamin
            $table->date('TTL'); // Tanggal Tempat Lahir
            $table->text('alamat_lengkap');
            $table->string('no_telp')->nullable();
            $table->foreignId('kepala_keluarga_id')->nullable()->constrained('penduduk'); // Self-referencing jika dia KK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penduduk');
    }
}
