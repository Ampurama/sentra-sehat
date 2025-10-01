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
        Schema::create('kesehatan_gizis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sektor_id')->constrained('sektors')->onDelete('cascade');
            $table->foreignId('penduduk_id')->constrained('penduduk')->onDelete('cascade');
            $table->decimal('bmi', 5, 2)->nullable(); // Body Mass Index
            $table->string('diet_type')->nullable(); // e.g., 'Balanced', 'High Carb'
            $table->text('deficiencies')->nullable(); // e.g., 'Vitamin D, Iron'
            $table->string('nutritional_status')->nullable(); // e.g., 'Normal', 'Malnourished'
            $table->date('assessment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kesehatan_gizis');
    }
};
