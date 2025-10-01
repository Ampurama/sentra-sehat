<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIcdCodeAndSpesialisasiToPenyakitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penyakits', function (Blueprint $table) {
            $table->string('icd_code')->nullable();
            $table->string('spesialisasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penyakits', function (Blueprint $table) {
            $table->dropColumn(['icd_code', 'spesialisasi']);
        });
    }
}
