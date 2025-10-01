<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanaLanjutansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_lanjutan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tindakan_intervensi_id')->constrained('tindakan_intervensi')->onDelete('cascade');
            $table->text('keluhan_komplikasi');
            $table->dateTime('jadwal_kontrol_berikutnya')->nullable();
            $table->string('terapi_lanjutan')->nullable();
            $table->string('kebutuhan_pendampingan')->nullable(); // PKM/Dokter/Kades
            $table->text('keterangan_lain')->nullable();
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
        Schema::dropIfExists('rencana_lanjutans');
    }
}
