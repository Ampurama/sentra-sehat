<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFaktorRisikoFieldsToPenduduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penduduk', function (Blueprint $table) {
            // Faktor Risiko fields
            $table->boolean('riwayat_merokok')->nullable()->default(false);
            $table->boolean('riwayat_alkohol')->nullable()->default(false);
            $table->boolean('riwayat_penyakit_keturunan')->nullable()->default(false);
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
            $table->dropColumn(['riwayat_merokok', 'riwayat_alkohol', 'riwayat_penyakit_keturunan']);
        });
    }
}
