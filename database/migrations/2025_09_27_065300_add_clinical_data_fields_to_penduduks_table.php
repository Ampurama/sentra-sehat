<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddClinicalDataFieldsToPenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            // Data Klinis Ringkas
            $table->text('data_klinis_ringkas')->nullable();

            // Diagnosis Utama & Penyerta
            $table->text('diagnosis_utama')->nullable();
            $table->text('diagnosis_penyerta')->nullable();

            // Tindakan Selama Perawatan
            $table->text('tindakan_perawatan')->nullable();

            // Obat Pulang
            $table->text('obat_pulang')->nullable();

            // Alat Kesehatan yang diperlukan di rumah
            $table->text('alat_kesehatan_rumah')->nullable();

            // Status fungsional saat pulang
            $table->string('status_fungsional_pulang')->nullable();

            // Hasil Pemeriksaan penting terakhir
            $table->text('hasil_pemeriksaan_terakhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropColumn([
                'data_klinis_ringkas',
                'diagnosis_utama',
                'diagnosis_penyerta',
                'tindakan_perawatan',
                'obat_pulang',
                'alat_kesehatan_rumah',
                'status_fungsional_pulang',
                'hasil_pemeriksaan_terakhir'
            ]);
        });
    }
}
