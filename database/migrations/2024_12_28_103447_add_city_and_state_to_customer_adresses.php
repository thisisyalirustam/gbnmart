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
        Schema::table('customer_adresses', function (Blueprint $table) {
            //
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->foreignId('state_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_adresses', function (Blueprint $table) {
            //
            $table->dropForeign(['city_id']);
            $table->dropForeign(['state_id']);
            $table->dropColumn(['city_id', 'state_id']);
        });
    }
};
