<?php

use App\Models\User;
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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->json('bank_details')->nullable();
            $table->string('coupon')->unique()->nullable();
            $table->boolean('status')->default(false);
            $table->string('percentage')->nullable();
            $table->enum('membership_tier', [
                'bronze',
                'silver',
                'gold',
                'diamond',
                'platinum',
                'elite',
                'premium',
                'vip'
            ])->default('bronze');
            $table->string('sales')->nullable();
            $table->string('amount')->nullable();
            $table->string('withdrawal')->nullable();
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
