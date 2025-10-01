<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kesehatan_anak_ibus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sektor_id')->constrained('sektors')->onDelete('cascade');
            $table->foreignId('penduduk_id')->constrained('penduduk')->onDelete('cascade');
            $table->boolean('child_vaccinations_complete')->default(false);
            $table->integer('maternal_checkups_count')->default(0);
            $table->decimal('birth_weight', 5, 2)->nullable(); // in kg
            $table->date('last_checkup')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesehatan_anak_ibus');
    }
};
