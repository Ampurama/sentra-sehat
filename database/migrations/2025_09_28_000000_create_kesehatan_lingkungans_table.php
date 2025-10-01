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
        Schema::create('kesehatan_lingkungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sektor_id')->constrained('sektors')->onDelete('cascade');
            $table->foreignId('wilayah_id')->constrained('wilayah')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->decimal('air_quality', 5, 2)->nullable(); // e.g., AQI index
            $table->string('sanitation_level')->nullable(); // e.g., 'Good', 'Fair'
            $table->string('waste_management')->nullable(); // e.g., 'Collected', 'Open Dumping'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesehatan_lingkungans');
    }
};
