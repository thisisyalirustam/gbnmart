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
        Schema::create('cities', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // City name
            $table->unsignedBigInteger('state_id')->nullable(); // Foreign key to states table
            $table->unsignedBigInteger('country_id'); // Foreign key to countries table
            $table->string('postal_code')->nullable(); // Postal/ZIP code
            $table->decimal('latitude', 10, 7)->nullable(); // Latitude for geolocation
            $table->decimal('longitude', 10, 7)->nullable(); // Longitude for geolocation
            $table->boolean('status')->default(true); // Active/inactive status
            $table->timestamps(); // created_at and updated_at
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
