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
        Schema::table('product_cats', function (Blueprint $table) {
            //
            $table->boolean('status')->default(1);
            $table->string('image')->nullable();
            $table->enum('sof',['yes','no'])->default('no');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_cats', function (Blueprint $table) {
            //
            $table->dropColumn(['status', 'image', 'sof']);
        });
    }
};
