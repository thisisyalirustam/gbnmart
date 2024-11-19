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
        //
        Schema::create('states', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // State name
            $table->unsignedBigInteger('country_id'); // Foreign key to countries table
            $table->string('abbreviation')->nullable(); // Abbreviation (e.g., CA, TX)
            $table->boolean('status')->default(true); // Active/inactive status
            $table->timestamps(); // created_at and updated_at

            // Define the foreign key relationship
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
