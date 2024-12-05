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
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the unit (e.g., kg, lb, cm, etc.)
            $table->string('symbol')->nullable(); // Symbol or abbreviation for the unit
            $table->string('type'); // Type of measurement (e.g., weight, length, volume)
            $table->boolean('is_active')->default(true); // Flag if unit is active or inactive
            $table->text('description')->nullable(); // Additional description of the unit
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
