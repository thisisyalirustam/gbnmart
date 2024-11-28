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
            $table->string('bank_invoice')->nullable();
            $table->enum('shipping_status', ['Pending', 'Process', 'Delivered', 'Return', 'Complete'])->default('Pending');
            $table->dateTime('delivered_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropColumn('bank_invoice');
            $table->dropColumn('shipping_status');
            $table->dropColumn('delivered_date');
        });
    }
};
