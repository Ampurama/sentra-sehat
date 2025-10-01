<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPenyakitIdToTindakanIntervensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tindakan_intervensi', function (Blueprint $table) {
            $table->foreignId('penyakit_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tindakan_intervensi', function (Blueprint $table) {
            $table->dropForeign(['penyakit_id']);
            $table->dropColumn('penyakit_id');
        });
    }
}
