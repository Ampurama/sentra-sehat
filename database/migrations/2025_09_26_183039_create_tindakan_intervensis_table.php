<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakanIntervensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan_intervensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('penduduk')->onDelete('cascade');
            $table->foreignId('petugas_id')->constrained('users'); // Dokter/Perawat yang melayani
            $table->date('tgl_tindakan');
            $table->string('diagnosis_utama');
            $table->string('tindakan_selama_perawatan')->nullable();
            $table->string('status_fungsional')->nullable(); // Status fungsional saat ini
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
        Schema::dropIfExists('tindakan_intervensis');
    }
}
