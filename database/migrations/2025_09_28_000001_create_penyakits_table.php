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
        Schema::create('penyakits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sektor_id')->constrained('sektors')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('symptoms')->nullable();
            $table->decimal('prevalence', 5, 2)->nullable(); // e.g., percentage rate
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyakits');
    }
};
