<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerformanceIndexes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add indexes to penduduk table
        Schema::table('penduduk', function (Blueprint $table) {
            $table->index('wilayah_id');
            $table->index('NIK');
            $table->index('nama');
            $table->index(['wilayah_id', 'created_at']);
            $table->index('created_at');
        });

        // Add indexes to wilayah table
        Schema::table('wilayah', function (Blueprint $table) {
            $table->index('nama_kecamatan');
            $table->index(['nama_kecamatan', 'nama_desa']);
            $table->index(['latitude', 'longitude']);
        });

        // Add indexes to tindakan_intervensi table
        Schema::table('tindakan_intervensi', function (Blueprint $table) {
            $table->index('pasien_id');
            $table->index('penyakit_id');
            $table->index(['pasien_id', 'penyakit_id']);
            $table->index('created_at');
            $table->index(['created_at', 'penyakit_id']);
        });

        // Add indexes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('role_id');
            $table->index('wilayah_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Drop indexes from penduduk table
        Schema::table('penduduk', function (Blueprint $table) {
            $table->dropIndex(['wilayah_id']);
            $table->dropIndex(['NIK']);
            $table->dropIndex(['nama']);
            $table->dropIndex(['wilayah_id', 'created_at']);
            $table->dropIndex(['created_at']);
        });

        // Drop indexes from wilayah table
        Schema::table('wilayah', function (Blueprint $table) {
            $table->dropIndex(['nama_kecamatan']);
            $table->dropIndex(['nama_kecamatan', 'nama_desa']);
            $table->dropIndex(['latitude', 'longitude']);
        });

        // Drop indexes from tindakan_intervensi table
        Schema::table('tindakan_intervensi', function (Blueprint $table) {
            $table->dropIndex(['pasien_id']);
            $table->dropIndex(['penyakit_id']);
            $table->dropIndex(['pasien_id', 'penyakit_id']);
            $table->dropIndex(['created_at']);
            $table->dropIndex(['created_at', 'penyakit_id']);
        });

        // Drop indexes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role_id']);
            $table->dropIndex(['wilayah_id']);
        });
    }
}
