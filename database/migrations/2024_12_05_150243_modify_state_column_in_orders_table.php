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
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('state');

            // Add the new state_id column and make it a foreign key
            $table->foreignId('state_id')->nullable()->constrained('states')->cascadeOnDelete();

            // Drop the existing city column (if needed)
            $table->dropColumn('city');

            // Add the new city_id column and make it a foreign key
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropForeign(['state_id']);
            $table->dropColumn('state_id');

            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');

            // Restore the original state column
            $table->string('state')->nullable();

            // Restore the original city column
            $table->string('city')->nullable();
        });
    }
};
